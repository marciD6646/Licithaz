using System.Net.Http.Headers;
using System.Net.Http.Json;
using System.Text.Json;
using Microsoft.Maui.Storage;

namespace licitAdminDashboard.Services
{
    public class ApiService
    {
        private readonly HttpClient _httpClient;

        public ApiService()
        {
            _httpClient = new HttpClient
            {
                BaseAddress = new Uri("http://localhost:8000/api/")
            };


        }

        private void ApplyAuthHeader()
        {
            var token = Preferences.Get("auth_token", "");

            _httpClient.DefaultRequestHeaders.Authorization = null;

            if (!string.IsNullOrEmpty(token))
            {
                _httpClient.DefaultRequestHeaders.Authorization =
                    new AuthenticationHeaderValue("Bearer", token);
            }
        }
        public async Task<(bool Success, string? ErrorMessage)> CreateProductAsync(

            string? name,
            string? category,
            string? description,
            string? extendedDescription,
            string? imagePath,
            string? starterBid,
            DateTime startDate,
            DateTime endDate)
        {
            ApplyAuthHeader();
            using var content = new MultipartFormDataContent();

            content.Add(new StringContent(name ?? string.Empty), "name");
            content.Add(new StringContent(category ?? ""), "category");
            content.Add(new StringContent(description ?? ""), "description");
            content.Add(new StringContent(extendedDescription ?? ""), "extended_description");
            content.Add(new StringContent(starterBid ?? "0"), "starter_bid");
            content.Add(new StringContent(startDate.ToString("yyyy-MM-dd")), "bid_start_date");
            content.Add(new StringContent(endDate.ToString("yyyy-MM-dd")), "bid_end_date");

            if (!string.IsNullOrEmpty(imagePath) && File.Exists(imagePath))
            {
                var stream = File.OpenRead(imagePath);
                var fileContent = new StreamContent(stream);
                fileContent.Headers.ContentType = new MediaTypeHeaderValue("image/jpeg");

                content.Add(fileContent, "image_url", Path.GetFileName(imagePath));
            }

            try
            {
                var response = await _httpClient.PostAsync("products", content);

                if (!response.IsSuccessStatusCode)
                {
                    var errorBody = await response.Content.ReadAsStringAsync();
                    return (false, $"Status: {response.StatusCode}, Body: {errorBody}");
                }

                return (true, null);
            }
            catch (Exception ex)
            {
                return (false, ex.Message);
            }
        }

        public async Task<Models.Product?> GetProductAsync(int id)
        {
            ApplyAuthHeader();
            try
            {
                var response = await _httpClient.GetAsync($"products/{id}");
                if (!response.IsSuccessStatusCode) return null;

                var rawJson = await response.Content.ReadAsStringAsync();

                using var doc = JsonDocument.Parse(rawJson);
                if (doc.RootElement.ValueKind != JsonValueKind.Object)
                {
                    return null;
                }

                // Some APIs wrap payload as { "product": { ... } }.
                if (doc.RootElement.TryGetProperty("product", out var prodElem) &&
                    prodElem.ValueKind == JsonValueKind.Object)
                {
                    return JsonSerializer.Deserialize<Models.Product>(prodElem.GetRawText());
                }

                // Otherwise treat root object as the product payload.
                return JsonSerializer.Deserialize<Models.Product>(rawJson);
            }
            catch
            {
                return null;
            }
        }

        public async Task<(bool Success, string? ErrorMessage)> PatchProductAsync(
            int id,
            Dictionary<string, string> changedFields,
            string? imagePath)
        {
            ApplyAuthHeader();

            try
            {
                HttpResponseMessage response;

                // For text-only updates, JSON PATCH is the most reliable with Laravel API routes.
                if (string.IsNullOrWhiteSpace(imagePath))
                {
                    var jsonContent = JsonContent.Create(changedFields);
                    using var request = new HttpRequestMessage(HttpMethod.Patch, $"products/{id}")
                    {
                        Content = jsonContent
                    };

                    response = await _httpClient.SendAsync(request);
                }
                else
                {
                    using var patchContent = BuildProductMultipartContent(changedFields, imagePath, includeMethodOverride: false);
                    using var request = new HttpRequestMessage(HttpMethod.Patch, $"products/{id}")
                    {
                        Content = patchContent
                    };

                    response = await _httpClient.SendAsync(request);
                }

                if (response.IsSuccessStatusCode)
                {
                    return (true, null);
                }

                // Laravel + multipart can reject direct PATCH; fallback to method spoofing via POST.
                using var fallbackContent = BuildProductMultipartContent(changedFields, imagePath, includeMethodOverride: true);
                response = await _httpClient.PostAsync($"products/{id}", fallbackContent);
                if (!response.IsSuccessStatusCode)
                {
                    var body = await response.Content.ReadAsStringAsync();
                    return (false, $"Status: {response.StatusCode}, Body: {body}");
                }

                return (true, null);
            }
            catch (Exception ex)
            {
                return (false, ex.Message);
            }
        }

        private static MultipartFormDataContent BuildProductMultipartContent(
            Dictionary<string, string> fields,
            string? imagePath,
            bool includeMethodOverride)
        {
            var content = new MultipartFormDataContent();
            foreach (var field in fields)
            {
                content.Add(new StringContent(field.Value), field.Key);
            }

            if (!string.IsNullOrEmpty(imagePath) && File.Exists(imagePath))
            {
                var stream = File.OpenRead(imagePath);
                var fileContent = new StreamContent(stream);
                fileContent.Headers.ContentType = new MediaTypeHeaderValue("image/jpeg");
                content.Add(fileContent, "image_url", Path.GetFileName(imagePath));
            }

            if (includeMethodOverride)
            {
                content.Add(new StringContent("PATCH"), "_method");
            }

            return content;
        }

        public async Task<(bool Success, string? ErrorMessage)> UpdateProductAsync(
            int id,
            string? name,
            string? category,
            string? description,
            string? extendedDescription,
            string? imagePath,
            string? starterBid,
            DateTime startDate,
            DateTime endDate)
        {
            ApplyAuthHeader();

            using var content = new MultipartFormDataContent();
            content.Add(new StringContent(name ?? string.Empty), "name");
            content.Add(new StringContent(category ?? ""), "category");
            content.Add(new StringContent(description ?? ""), "description");
            content.Add(new StringContent(extendedDescription ?? ""), "extended_description");
            content.Add(new StringContent(starterBid ?? "0"), "starter_bid");
            content.Add(new StringContent(startDate.ToString("yyyy-MM-dd")), "bid_start_date");
            content.Add(new StringContent(endDate.ToString("yyyy-MM-dd")), "bid_end_date");

            if (!string.IsNullOrEmpty(imagePath) && File.Exists(imagePath))
            {
                var stream = File.OpenRead(imagePath);
                var fileContent = new StreamContent(stream);
                fileContent.Headers.ContentType = new MediaTypeHeaderValue("image/jpeg");
                content.Add(fileContent, "image_url", Path.GetFileName(imagePath));
            }

            // Some backends (Laravel) don't accept multipart with PUT; use POST with
            // method spoofing so the server treats it as a PUT.
            content.Add(new StringContent("PUT"), "_method");

            try
            {
                var response = await _httpClient.PostAsync($"products/{id}", content);

                if (!response.IsSuccessStatusCode)
                {
                    var body = await response.Content.ReadAsStringAsync();
                    return (false, $"Status: {response.StatusCode}, Body: {body}");
                }

                return (true, null);
            }
            catch (Exception ex)
            {
                return (false, ex.Message);
            }
        }

        public async Task<bool> DeleteProductAsync(int id)
        {
            ApplyAuthHeader();
            var response = await _httpClient.DeleteAsync($"products/{id}");
            return response.IsSuccessStatusCode;
        }
    }
}