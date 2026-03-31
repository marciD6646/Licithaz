using System;
using System.Collections.Generic;
using System.Text;
using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class Product
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public string Category { get; set; }

        [JsonPropertyName("starter_bid")]
        public decimal StarterBid { get; set; }
    }
}