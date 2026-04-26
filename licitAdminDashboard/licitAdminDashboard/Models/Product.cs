using System;
using System.Collections.Generic;
using System.Text;
using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class Product
    {

        public int Id { get; set; }

        [JsonPropertyName("name")]
        public string Name { get; set; }

        [JsonPropertyName("category")]
        public string Category { get; set; }

        [JsonPropertyName("description")]
        public string Description { get; set; }

        [JsonPropertyName("extended_description")]
        public string ExtendedDescription { get; set; }

        [JsonPropertyName("image_url")]
        public string ImageUrl { get; set; }

        [JsonPropertyName("starter_bid")]
        public decimal StarterBid { get; set; }

        [JsonPropertyName("bid_start_date")]
        public DateTime BidStartDate { get; set; }

        [JsonPropertyName("bid_end_date")]
        public DateTime BidEndDate { get; set; }
    }
}