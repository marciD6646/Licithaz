using System;
using System.Collections.Generic;
using System.Text;

namespace licitAdminDashboard.Models
{
    public class Product
    {
        public int Id { get; set; }
        public string Name { get; set; }
        public string Category { get; set; }
        public decimal StarterBid { get; set; }
    }
}