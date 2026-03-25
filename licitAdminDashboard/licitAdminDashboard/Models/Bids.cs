using System;
using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class Bid
    {
        public int Id { get; set; }
        public decimal Amount { get; set; }

        [JsonPropertyName("created_at")]
        public DateTime CreatedAt { get; set; }
    }
}