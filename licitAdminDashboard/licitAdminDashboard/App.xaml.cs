using Microsoft.Extensions.DependencyInjection;

namespace licitAdminDashboard
{
    public partial class App : Application
    {
        public App()
        {
            InitializeComponent();
            MainPage = new NavigationPage(new LoginPage());
        }
    }
}
