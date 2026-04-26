using Microsoft.Extensions.DependencyInjection;

namespace licitAdminDashboard
{
    public partial class App : Application
    {
        public App()
        {
            InitializeComponent();
        }
        // =========================
        //    ALKALMAZÁS INDÍTÁSA
        // =========================
        protected override Window CreateWindow(IActivationState? activationState)
        {
            return new Window(new NavigationPage(new LoginPage()));
        }
    }
}
