using System.Net.Http.Headers;
using System.Net.Http.Json;
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

            string name,
            string category,
            string description,
            string extendedDescription,
            string imagePath,
            string starterBid,
            DateTime startDate,
            DateTime endDate)
        {
            ApplyAuthHeader();
            var content = new MultipartFormDataContent();

            content.Add(new StringContent(name), "name");
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
                var product = await response.Content.ReadFromJsonAsync<Models.Product>();
                if (product != null) return product;

                // Fallback: some APIs wrap the product in an object like { "product": { ... } }
                try
                {
                    var doc = await response.Content.ReadFromJsonAsync<System.Text.Json.JsonElement>();
                    if (doc.ValueKind == System.Text.Json.JsonValueKind.Object && doc.TryGetProperty("product", out var prodElem))
                    {
                        var prodJson = prodElem.GetRawText();
                        return System.Text.Json.JsonSerializer.Deserialize<Models.Product>(prodJson);
                    }
                }
                catch { }

                return null;
            }
            catch
            {
                return null;
            }
        }

        public async Task<(bool Success, string? ErrorMessage)> UpdateProductAsync(
            int id,
            string name,
            string category,
            string description,
            string extendedDescription,
            string imagePath,
            string starterBid,
            DateTime startDate,
            DateTime endDate)
        {
            ApplyAuthHeader();

            var content = new MultipartFormDataContent();
            content.Add(new StringContent(name), "name");
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