using licitAdminDashboard.Services;

namespace licitAdminDashboard;

public partial class NewProduct : ContentPage
{
    private string selectedImagePath = string.Empty;
    private readonly ApiService _apiService;

    public NewProduct()
    {
        InitializeComponent();
        _apiService = new ApiService();
    }
    // =========================
    //   NEW PRODUCT FELVÉTELE
    // =========================

    //kép kiválasztás
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

    //New product feltöltés
    private async void OnSubmitProductClicked(object? sender, EventArgs e)
    {
        try
        {
            var result = await _apiService.CreateProductAsync(
                NameEntry.Text ?? string.Empty,
                CategoryPicker.SelectedItem?.ToString(),
                DescriptionEditor.Text,
                ExtendedDescriptionEditor.Text,
                selectedImagePath,
                StarterBidEntry.Text,
                StartDatePicker.Date ?? DateTime.Today,
                EndDatePicker.Date ?? DateTime.Today
            );

            if (result.Success)
            {
                await DisplayAlertAsync("Success", "Product created!", "OK");
                await Navigation.PopAsync();
            }
            else
            {
                await DisplayAlertAsync("Error", result.ErrorMessage ?? "Upload failed", "OK");
            }
        }
        catch (Exception ex)
        {
            await DisplayAlertAsync("Error", $"Upload failed: {ex.Message}", "OK");
        }
    }
}