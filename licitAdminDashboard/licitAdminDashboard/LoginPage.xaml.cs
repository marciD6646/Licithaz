using System;
using System.Net.Http;
using System.Text;
using System.Text.Json;
using System.Threading.Tasks;
using Microsoft.Maui.Controls; 
using Microsoft.Maui.Storage; 

namespace licitAdminDashboard
{
    public partial class LoginPage : ContentPage
    {
        public LoginPage()
        {
            InitializeComponent();
        }

        private async void OnLoginClicked(object sender, EventArgs e)
        {
            var email = EmailEntry.Text;
            var password = PasswordEntry.Text;

            if (string.IsNullOrEmpty(email) || string.IsNullOrEmpty(password))
            {
                ErrorLabel.Text = "Minden mezőt tölts ki!";
                ErrorLabel.IsVisible = true;
                return;
            }

            var client = new HttpClient();

            var loginData = new
            {
                email = email,
                password = password
            };

            var json = JsonSerializer.Serialize(loginData);
            var content = new StringContent(json, Encoding.UTF8, "application/json");

            try
            {
                var response = await client.PostAsync("http://127.0.0.1:8000/api/admin/login", content);
                var responseContent = await response.Content.ReadAsStringAsync();

                if (response.IsSuccessStatusCode)
                {
                    var result = JsonSerializer.Deserialize<LoginResponse>(responseContent);

                   
                    Preferences.Set("auth_token", result.token);

                    
                    Application.Current.MainPage = new NavigationPage(new MainPage());
                }
                else
                {
                    ErrorLabel.Text = responseContent;
                    ErrorLabel.IsVisible = true;
                }
            }
            catch (Exception ex)
            {
                ErrorLabel.Text = "Szerver hiba: " + ex.Message;
                ErrorLabel.IsVisible = true;
            }
        }
    }
    public class LoginResponse
    {
        public string token { get; set; }
        public string token_type { get; set; }
    }
}