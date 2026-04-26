using System;
using System.Collections.Generic;
using System.Linq;
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
            LoadPayments();

            UsersBtn.Clicked += ShowUsers;
            ProductsBtn.Clicked += ShowProducts;
            BidsBtn.Clicked += ShowBids;
            PaymentsBtn.Clicked += ShowPayments;
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
                await DisplayAlertAsync("Error loading products", ex.Message, "OK");
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
                await DisplayAlertAsync("Error loading users", ex.Message, "OK");
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
                await DisplayAlertAsync("Error loading bids", ex.Message, "OK");
            }
        }

        private async void LoadPayments()
        {
            try
            {
                var token = Preferences.Get("auth_token", string.Empty);

                if (!string.IsNullOrEmpty(token))
                {
                    _httpClient.DefaultRequestHeaders.Authorization =
                        new System.Net.Http.Headers.AuthenticationHeaderValue("Bearer", token);
                }

                var response = await _httpClient.GetFromJsonAsync<PaymentResponse>("payments");
                if (response != null && response.Payments != null)
                {
                    PaymentsList.ItemsSource = response.Payments;
                }
            }
            catch (Exception ex)
            {
                await DisplayAlertAsync("Error loading payments", ex.Message, "OK");
            }
        }

        private async Task LoadUserBids(int userId)
        {
            try
            {
                var bids = await _httpClient.GetFromJsonAsync<List<Bid>>($"admin/users/{userId}/bids");

                if (bids == null || bids.Count == 0)
                {
                    await DisplayAlertAsync("Info", "Ez a felhasználó még nem licitált semmire.", "OK");
                    return;
                }

                UserBidsList.ItemsSource = bids;

                ShowUserBids();
            }
            catch (Exception ex)
            {
                await DisplayAlertAsync("Error loading user bids", ex.Message, "OK");
            }
        }

        private async void LogOutAdmin(object? sender, EventArgs e)
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
                var window = Application.Current?.Windows.FirstOrDefault();
                if (window is not null)
                {
                    window.Page = new NavigationPage(new LoginPage());
                }
            }
        }

        private async void OnBanClicked(object? sender, EventArgs e)
        {
            if (sender is not Button button || button.CommandParameter is null)
            {
                return;
            }

            if (!int.TryParse(button.CommandParameter.ToString(), out var userId))
            {
                return;
            }

            try
            {
                await _httpClient.PostAsync($"admin/users/ban/{userId}", null);
                LoadUsers();
            }
            catch (Exception ex)
            {
                await DisplayAlertAsync("Error", ex.Message, "OK");
            }
        }

        private async void OnUnbanClicked(object? sender, EventArgs e)
        {
            if (sender is not Button button || button.CommandParameter is null)
            {
                return;
            }

            if (!int.TryParse(button.CommandParameter.ToString(), out var userId))
            {
                return;
            }

            try
            {
                await _httpClient.PostAsync($"admin/users/unban/{userId}", null);
                LoadUsers();
            }
            catch (Exception ex)
            {
                await DisplayAlertAsync("Error", ex.Message, "OK");
            }
        }

        // =========================
        // TAB SWITCHING
        // =========================
        private void ShowProducts(object? sender, EventArgs e)
        {
            AddProductbtn.IsVisible = true;
            ProductsList.IsVisible = true;
            UsersList.IsVisible = false;
            BidsList.IsVisible = false;
            PaymentsList.IsVisible = false;
            UserBidsList.IsVisible = false;
        }

        private void ShowUsers(object? sender, EventArgs e)
        {
            AddProductbtn.IsVisible = false;
            ProductsList.IsVisible = false;
            UsersList.IsVisible = true;
            BidsList.IsVisible = false;
            PaymentsList.IsVisible = false;
            UserBidsList.IsVisible = false;


        }

        private void ShowBids(object? sender, EventArgs e)
        {
            AddProductbtn.IsVisible = false;
            ProductsList.IsVisible = false;
            UsersList.IsVisible = false;
            BidsList.IsVisible = true;
            PaymentsList.IsVisible = false;
            UserBidsList.IsVisible = false;


        }

        private void ShowPayments(object? sender, EventArgs e)
        {
            AddProductbtn.IsVisible = false;
            ProductsList.IsVisible = false;
            UsersList.IsVisible = false;
            BidsList.IsVisible = false;
            PaymentsList.IsVisible = true;
            UserBidsList.IsVisible = false;
        }

        private void ShowUserBids()
        {
            AddProductbtn.IsVisible = false;
            ProductsList.IsVisible = false;
            UsersList.IsVisible = false;
            BidsList.IsVisible = false;
            PaymentsList.IsVisible = false;
            UserBidsList.IsVisible = true;
        }
        private async void OpenNewProductPage(object? sender, EventArgs e)
        {
            await Navigation.PushAsync(new NewProduct());
        }

        protected override void OnAppearing()
        {
            base.OnAppearing();
            LoadProducts();
        }

        private async void OnEditProductClicked(object? sender, EventArgs e)
        {
            if (sender is Button btn && btn.CommandParameter is not null)
            {
                if (int.TryParse(btn.CommandParameter.ToString(), out int productId))
                {
                    await Navigation.PushAsync(new EditProductPage(productId));
                }
            }
        }

        private async void OnDeleteProductClicked(object? sender, EventArgs e)
        {
            if (sender is Button btn && btn.CommandParameter is not null)
            {
                if (int.TryParse(btn.CommandParameter.ToString(), out int productId))
                {
                    var confirm = await DisplayAlertAsync("Confirm", "Are you sure you want to delete this product?", "Yes", "No");
                    if (!confirm) return;

                    try
                    {
                        var api = new Services.ApiService();
                        var success = await api.DeleteProductAsync(productId);
                        if (success)
                        {
                            await DisplayAlertAsync("Success", "Product deleted", "OK");
                            LoadProducts();
                        }
                        else
                        {
                            await DisplayAlertAsync("Error", "Delete failed", "OK");
                        }
                    }
                    catch (Exception ex)
                    {
                        await DisplayAlertAsync("Error", ex.Message, "OK");
                    }
                }
            }
        }
    }
}
