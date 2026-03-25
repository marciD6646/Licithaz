using System.Collections.Generic;
using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class ProductResponse
    {
        [JsonPropertyName("products")]
        public List<Product> Products { get; set; }
    }
}
