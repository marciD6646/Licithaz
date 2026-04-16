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

        await Navigation.PopAsync(); // go back to MainPage
    }
}


/*
 * namespace licitAdminDashboard;

public partial class NewProduct : ContentPage
{
    public NewProduct()
    {
        InitializeComponent();
    }
   private async void OnSubmitProductClicked(object sender, EventArgs e)
{
    var api = new ApiService();

    var product = new
    {
        name = NameEntry.Text,
        category = CategoryPicker.SelectedItem?.ToString(),
        description = DescriptionEditor.Text,
        extended_description = ExtendedDescriptionEditor.Text,
        starter_bid = StarterBidEntry.Text,
        bid_start_date = StartDatePicker.Date,
        bid_end_date = EndDatePicker.Date,
        image_url = _uploadedImageUrl // from step 2
    };

    await api.CreateProductAsync(product);

    await DisplayAlert("Success", "Product created!", "OK");
    await Navigation.PopAsync();
}
}
*/
