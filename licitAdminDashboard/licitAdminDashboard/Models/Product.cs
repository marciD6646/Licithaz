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

        public string Description { get; set; }

        public string ExtendedDescription { get; set; }

        public string ImageUrl { get; set; }

        [JsonPropertyName("starter_bid")]
        public decimal StarterBid { get; set; }

        public DateTime StartDate { get; set; }

        public DateTime EndDate { get; set; }
    }
}