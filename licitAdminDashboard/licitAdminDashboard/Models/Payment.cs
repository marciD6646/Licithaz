using System;
using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class Payment
    {
        public int Id { get; set; }

        [JsonPropertyName("user_id")]
        public int UserId { get; set; }

        [JsonPropertyName("product_id")]
        public int ProductId { get; set; }

        public decimal Amount { get; set; }

        [JsonPropertyName("is_paid")]
        public bool IsPaid { get; set; }

        [JsonPropertyName("created_at")]
        public DateTime CreatedAt { get; set; }

        public User User { get; set; } = new();
        public Product Product { get; set; } = new();
    }
}
