using System.Text.Json.Serialization;

namespace licitAdminDashboard.Models
{
    public class User
    {
        public int Id { get; set; }
        public string Name { get; set; } = string.Empty;
        public string Email { get; set; } = string.Empty;

        [JsonPropertyName("is_admin")]
        public bool IsAdmin { get; set; }

        [JsonPropertyName("is_banned")]
        public bool IsBanned { get; set; }
    }
}