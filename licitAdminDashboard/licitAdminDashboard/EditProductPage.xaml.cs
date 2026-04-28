using licitAdminDashboard.Services;
using System.Globalization;
using Microsoft.Maui.Storage;

namespace licitAdminDashboard;

public partial class EditProductPage : ContentPage
{
    private readonly ApiService _apiService;
    private readonly int _productId;
    private string selectedImagePath = string.Empty;
    private Models.Product? _originalProduct;

    public EditProductPage(int productId)
    {
        InitializeComponent();
        _apiService = new ApiService();
        _productId = productId;
    }

    //==========================
    //     TERMÉK BETÖLTÉSE
    //==========================
    private async Task LoadProduct()
    {
        try
        {
            var product = await _apiService.GetProductAsync(_productId);

            if (product == null)
            {
                await DisplayAlertAsync("Error", "Product not found or API error. Check console for details.", "OK");
                return;
            }

            _originalProduct = product;

            NameEntry.Text = product.Name;

            if (!string.IsNullOrWhiteSpace(product.Category) && !CategoryPicker.Items.Contains(product.Category))
            {
                CategoryPicker.Items.Add(product.Category);
            }

            CategoryPicker.SelectedItem = product.Category;
            DescriptionEditor.Text = product.Description;
            ExtendedDescriptionEditor.Text = product.ExtendedDescription;
            StarterBidEntry.Text = product.StarterBid.ToString();

            // Handle date parsing
            if (product.BidStartDate != default)
                StartDatePicker.Date = product.BidStartDate;
            if (product.BidEndDate != default)
                EndDatePicker.Date = product.BidEndDate;

            if (!string.IsNullOrEmpty(product.ImageUrl))
            {
                var imageUri = ResolveImageUri(product.ImageUrl);
                if (imageUri != null)
                {
                    PreviewImage.Source = ImageSource.FromUri(imageUri);
                }
            }
        }
        catch (Exception ex)
        {
            await DisplayAlertAsync("Error", $"Failed to load product: {ex.Message}", "OK");
        }
    }
    // Oldal megjelenésekor betölti a termék adatait
    protected override async void OnAppearing()
    {
        base.OnAppearing();
        await LoadProduct();
    }

    //Kép kiválasztása a fájlrendszerből
    private async void OnPickImageClicked(object? sender, EventArgs e)
    {
        var result = await FilePicker.PickAsync(new PickOptions
        {
            PickerTitle = "Select image",
            FileTypes = FilePickerFileType.Images
        });

        if (result != null)
        {
            selectedImagePath = result.FullPath;
            PreviewImage.Source = ImageSource.FromFile(selectedImagePath);
        }
    }

    //Termék adatainak frissítése a szerveren
    private async void OnUpdateProductClicked(object? sender, EventArgs e)
    {
        //Error handling 
        if (string.IsNullOrWhiteSpace(NameEntry.Text))
        {
            await DisplayAlertAsync("Error", "Name is required.", "OK");
            return;
        }

        if (CategoryPicker.SelectedItem == null)
        {
            await DisplayAlertAsync("Error", "Category is required.", "OK");
            return;
        }

        if (string.IsNullOrWhiteSpace(DescriptionEditor.Text))
        {
            await DisplayAlertAsync("Error", "Description is required.", "OK");
            return;
        }

        if (string.IsNullOrWhiteSpace(ExtendedDescriptionEditor.Text))
        {
            await DisplayAlertAsync("Error", "Extended description is required.", "OK");
            return;
        }

        if (string.IsNullOrWhiteSpace(StarterBidEntry.Text))
        {
            await DisplayAlertAsync("Error", "Starter bid is required.", "OK");
            return;
        }

        try
        {
            if (_originalProduct == null)
            {
                await DisplayAlertAsync("Error", "Original product data not loaded.", "OK");
                return;
            }

            var startDate = StartDatePicker.Date ?? DateTime.Today;
            var endDate = EndDatePicker.Date ?? DateTime.Today;
            if (endDate < startDate)
            {
                await DisplayAlertAsync("Validation", "End date must be after or equal to start date.", "OK");
                return;
            }

            var changedFields = new Dictionary<string, string>();

            var name = NameEntry.Text?.Trim() ?? string.Empty;
            if (!string.Equals(name, _originalProduct.Name, StringComparison.Ordinal))
            {
                changedFields["name"] = name;
            }

            var category = CategoryPicker.SelectedItem?.ToString() ?? _originalProduct.Category;
            if (!string.Equals(category, _originalProduct.Category, StringComparison.Ordinal))
            {
                changedFields["category"] = category;
            }

            var description = DescriptionEditor.Text?.Trim() ?? string.Empty;
            if (!string.Equals(description, _originalProduct.Description, StringComparison.Ordinal))
            {
                changedFields["description"] = description;
            }

            var extendedDescription = ExtendedDescriptionEditor.Text?.Trim() ?? string.Empty;
            if (!string.Equals(extendedDescription, _originalProduct.ExtendedDescription, StringComparison.Ordinal))
            {
                changedFields["extended_description"] = extendedDescription;
            }

            var starterBid = StarterBidEntry.Text?.Trim() ?? "0";
            if (!decimal.TryParse(starterBid, NumberStyles.Number, CultureInfo.CurrentCulture, out var starterBidValue) &&
                !decimal.TryParse(starterBid, NumberStyles.Number, CultureInfo.InvariantCulture, out starterBidValue))
            {
                await DisplayAlertAsync("Validation", "Starter bid must be a valid number.", "OK");
                return;
            }

            if (starterBidValue != _originalProduct.StarterBid)
            {
                changedFields["starter_bid"] = starterBidValue.ToString(CultureInfo.InvariantCulture);
            }

            if (startDate.Date != _originalProduct.BidStartDate.Date)
            {
                changedFields["bid_start_date"] = startDate.ToString("yyyy-MM-dd");
            }

            if (endDate.Date != _originalProduct.BidEndDate.Date)
            {
                changedFields["bid_end_date"] = endDate.ToString("yyyy-MM-dd");
            }

            var hasImageChange = !string.IsNullOrWhiteSpace(selectedImagePath);
            if (changedFields.Count == 0 && !hasImageChange)
            {
                await DisplayAlertAsync("Info", "No changes to update.", "OK");
                return;
            }

            var result = await _apiService.PatchProductAsync(_productId, changedFields, selectedImagePath);

            if (result.Success)
            {
                await DisplayAlertAsync("Success", "Product updated!", "OK");
                await Navigation.PopAsync();
            }
            else
            {
                await DisplayAlertAsync("Error", result.ErrorMessage ?? "Update failed", "OK");
            }
        }
        catch (Exception ex)
        {
            await DisplayAlertAsync("Error", $"Update failed: {ex.Message}", "OK");
        }
    }
    // Megpróbál érvényes képet URI-t létrehozni
    private static Uri? ResolveImageUri(string imageUrl)
    {
        if (Uri.TryCreate(imageUrl, UriKind.Absolute, out var absoluteUri))
        {
            return absoluteUri;
        }

        var normalizedPath = imageUrl.Trim();
        if (!normalizedPath.StartsWith("/"))
        {
            normalizedPath = $"/{normalizedPath}";
        }

        var pathCandidates = new List<string> { normalizedPath };
        if (!normalizedPath.StartsWith("/storage/", StringComparison.OrdinalIgnoreCase))
        {
            pathCandidates.Add($"/storage{normalizedPath}");
        }

        var hostCandidates = new[]
        {
            "http://localhost:8000",
            "http://127.0.0.1:8000"
        };

        foreach (var host in hostCandidates)
        {
            foreach (var path in pathCandidates)
            {
                if (Uri.TryCreate($"{host}{path}", UriKind.Absolute, out var candidate))
                {
                    return candidate;
                }
            }
        }

        return null;
    }
}