namespace licitAdminDashboard;

public partial class NewProduct : ContentPage
{
    public NewProduct()
    {
        InitializeComponent();
    }
    private async void OnSubmitProductClicked(object sender, EventArgs e)
    {
        var product = new
        {
            Name = NameEntry.Text,
            Category = CategoryPicker.SelectedItem?.ToString(),
            Description = DescriptionEditor.Text,
            ExtendedDescription = ExtendedDescriptionEditor.Text,
            Image = ImageEntry.Text,
            StarterBid = StarterBidEntry.Text,
            StartDate = StartDatePicker.Date,
            EndDate = EndDatePicker.Date
        };

        // TODO: send to API or database
        await DisplayAlert("Success", "Product created!", "OK");

        await Navigation.PopAsync(); //vissza visz a MainPage-re
    }
}
