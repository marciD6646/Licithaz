using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Net.Http.Json;
using Microsoft.Maui.Controls;
using licitAdminDashboard.Models;

namespace licitAdminDashboard
{
    public partial class MainPage : ContentPage

    {
        private readonly HttpClient _httpClient;
        public Command<int> UserDoubleTappedCommand { get; }

        public MainPage()
        {
            InitializeComponent();

            _httpClient = new HttpClient
            {
                BaseAddress = new Uri("http://127.0.0.1:8000/api/")
            };

            UserDoubleTappedCommand = new Command<int>(async (userId) =>
            {
                await LoadUserBids(userId);
            });

            BindingContext = this;

            LoadProducts();
            LoadUsers();
            LoadBids();

            UsersBtn.Clicked += ShowUsers;
            ProductsBtn.Clicked += ShowProducts;
            BidsBtn.Clicked += ShowBids;
        }

        // =========================
        // LOAD DATA FROM API
        // =========================
        private async void LoadProducts()
        {
            try
            {
                var response = await _httpClient.GetFromJsonAsync<ProductResponse>("products");

                if (response != null && response.Products != null)
                {
                    ProductsList.ItemsSource = response.Products;
                    ProductsCountLabel.Text = response.Products.Count.ToString();
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("Error loading products", ex.Message, "OK");
            }
        }

        private async void LoadUsers()
        {
            try
            {
                var token = Preferences.Get("auth_token", string.Empty);

                if (!string.IsNullOrEmpty(token))
                {
                    _httpClient.DefaultRequestHeaders.Authorization =
                        new System.Net.Http.Headers.AuthenticationHeaderValue("Bearer", token);
                }

                var users = await _httpClient.GetFromJsonAsync<List<User>>("admin/users");

                if (users != null)
                {
                    UsersList.ItemsSource = users;
                    UsersCountLabel.Text = users.Count.ToString();
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("Error loading users", ex.Message, "OK");
            }
        }

        private async void LoadBids()
        {
            try
            {
                var bids = await _httpClient.GetFromJsonAsync<List<Bid>>("bids");
                if (bids != null)
                {
                    BidsList.ItemsSource = bids;
                    BidsCountLabel.Text = bids.Count.ToString();
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("Error loading bids", ex.Message, "OK");
            }
        }
        private async Task LoadUserBids(int userId)
        {
            try
            {
                var bids = await _httpClient.GetFromJsonAsync<List<Bid>>($"admin/users/{userId}/bids");

                if (bids != null)
                {
                    // opció 1: megjeleníted a meglévő BidsList-ben
                    BidsList.ItemsSource = bids;

                    // átváltasz a bids tabra
                    ShowBids(null, null);
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("Error loading user bids", ex.Message, "OK");
            }
        }
        private async void LogOutAdmin(object sender, EventArgs e)
        {
            try
            {
                var token = Preferences.Get("auth_token", string.Empty);
                
                if (!string.IsNullOrEmpty(token))
                {
                    _httpClient.DefaultRequestHeaders.Authorization = 
                        new System.Net.Http.Headers.AuthenticationHeaderValue("Bearer", token);
                    
                    await _httpClient.PostAsync("admin/logout", null);
                }
            }
            catch (Exception ex)
            {
                System.Diagnostics.Debug.WriteLine($"Logout error: {ex.Message}");
            }
            finally
            {
                Preferences.Remove("auth_token");
                Application.Current.MainPage = new NavigationPage(new LoginPage());
            }
        }

        private async void OnBanClicked(object sender, EventArgs e)
        {


            var button = sender as Button;
            var userId = (int)button.CommandParameter;

            try
            {
                await _httpClient.PostAsync($"admin/users/ban/{userId}", null); ;
                LoadUsers(); 
            }
            catch (Exception ex)
            {
                await DisplayAlert("Error", ex.Message, "OK");
            }
        }

        private async void OnUnbanClicked(object sender, EventArgs e)
        {

            var button = sender as Button;
            var userId = (int)button.CommandParameter;

            try
            {
                await _httpClient.PostAsync($"admin/users/unban/{userId}", null);
                LoadUsers(); 
            }
            catch (Exception ex)
            {
                await DisplayAlert("Error", ex.Message, "OK");
            }
        }

        // =========================
        // TAB SWITCHING
        // =========================
        private void ShowProducts(object sender, EventArgs e)
        {
            ProductsList.IsVisible = true;
            UsersList.IsVisible = false;
            BidsList.IsVisible = false;
        }

        private void ShowUsers(object sender, EventArgs e)
        {
            ProductsList.IsVisible = false;
            UsersList.IsVisible = true;
            BidsList.IsVisible = false;

            
        }

        private void ShowBids(object sender, EventArgs e)
        {
            ProductsList.IsVisible = false;
            UsersList.IsVisible = false;
            BidsList.IsVisible = true;

           
        }
    }
}