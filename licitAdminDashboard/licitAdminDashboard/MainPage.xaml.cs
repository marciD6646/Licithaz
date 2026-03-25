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

        public MainPage()
        {
            InitializeComponent();

            _httpClient = new HttpClient
            {
                // ⚠️ CHANGE THIS depending on your setup
                BaseAddress = new Uri("http://127.0.0.1:8000/api/")
            };

            // Load data
            LoadProducts();

            // Button events
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
                var users = await _httpClient.GetFromJsonAsync<List<User>>("users");
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

            LoadUsers();
        }

        private void ShowBids(object sender, EventArgs e)
        {
            ProductsList.IsVisible = false;
            UsersList.IsVisible = false;
            BidsList.IsVisible = true;

            LoadBids();
        }
    }
}