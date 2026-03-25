using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class User
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public string Email { get; set; }

        [JsonPropertyName("is_admin")]
        public bool IsAdmin { get; set; }
    }
}