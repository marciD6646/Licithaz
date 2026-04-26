using System.Collections.Generic;
using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class PaymentResponse
    {
        [JsonPropertyName("payments")]
        public List<Payment> Payments { get; set; } = new();
    }
}
