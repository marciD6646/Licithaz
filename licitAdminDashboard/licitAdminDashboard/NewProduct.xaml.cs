using licitAdminDashboard.Services;

namespace licitAdminDashboard;

public partial class NewProduct : ContentPage
{
    private string selectedImagePath;
    private readonly ApiService _apiService;

    public NewProduct()
    {
        InitializeComponent();
        _apiService = new ApiService();
    }

    // 📸 kép kiválasztás
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

    // 🚀 feltöltés
    private async void OnSubmitProductClicked(object sender, EventArgs e)
    {
        try
        {
            var result = await _apiService.CreateProductAsync(
                NameEntry.Text,
                CategoryPicker.SelectedItem?.ToString(),
                DescriptionEditor.Text,
                ExtendedDescriptionEditor.Text,
                selectedImagePath,
                StarterBidEntry.Text,
                (DateTime)StartDatePicker.Date,
                (DateTime)EndDatePicker.Date
            );

            if (result.Success)
            {
                await DisplayAlert("Success", "Product created!", "OK");
                await Navigation.PopAsync();
            }
            else
            {
                await DisplayAlert("Error", result.ErrorMessage ?? "Upload failed", "OK");
            }
        }
        catch (Exception ex)
        {
            await DisplayAlert("Error", $"Upload failed: {ex.Message}", "OK");
        }
    }
}