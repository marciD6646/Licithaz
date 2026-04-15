using System;
using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class Bid
    {
        public int Id { get; set; }

        [JsonPropertyName("user_id")]
        public int UserId { get; set; }

        public decimal Amount { get; set; }

        [JsonPropertyName("auction_item_id")]
        public int AuctionItemId { get; set; }

        [JsonPropertyName("created_at")]
        public DateTime CreatedAt { get; set; }

        [JsonPropertyName("updated_at")]
        public DateTime UpdatedAt { get; set; }
    }
}