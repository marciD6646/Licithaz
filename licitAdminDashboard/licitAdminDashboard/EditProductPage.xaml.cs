using licitAdminDashboard.Services;
using Microsoft.Maui.Storage;

namespace licitAdminDashboard;

public partial class EditProductPage : ContentPage
{
    private readonly ApiService _apiService;
    private int _productId;
    private string selectedImagePath;

    public EditProductPage(int productId)
    {
        InitializeComponent();
        _apiService = new ApiService();
        _productId = productId;
    }

    // 📥 TERMÉK BETÖLTÉS
    private async Task LoadProduct()
    {
        try
        {
            var product = await _apiService.GetProductAsync(_productId);

            if (product == null)
            {
                await DisplayAlert("Error", "Product not found or API error. Check console for details.", "OK");
                return;
            }

            NameEntry.Text = product.Name;
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
                PreviewImage.Source = ImageSource.FromUri(new Uri(product.ImageUrl));
            }
        }
        catch (Exception ex)
        {
            await DisplayAlert("Error", $"Failed to load product: {ex.Message}", "OK");
        }
    }

    protected override async void OnAppearing()
    {
        base.OnAppearing();
        await LoadProduct();
    }

    // 📸 KÉP CSERE
    private async void OnPickImageClicked(object sender, EventArgs e)
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

    // 🚀 UPDATE
    private async void OnUpdateProductClicked(object sender, EventArgs e)
    {
        try
        {
            var result = await _apiService.UpdateProductAsync(
                _productId,
                NameEntry.Text,
                CategoryPicker.SelectedItem?.ToString(),
                DescriptionEditor.Text,
                ExtendedDescriptionEditor.Text,
                selectedImagePath,
                StarterBidEntry.Text,
                StartDatePicker.Date.Value,
                EndDatePicker.Date.Value
            );

            if (result.Success)
            {
                await DisplayAlert("Success", "Product updated!", "OK");
                await Navigation.PopAsync();
            }
            else
            {
                await DisplayAlert("Error", result.ErrorMessage ?? "Update failed", "OK");
            }
        }
        catch (Exception ex)
        {
            await DisplayAlert("Error", $"Update failed: {ex.Message}", "OK");
        }
    }
}