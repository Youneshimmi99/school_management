import Dashboard from "./components/Admin/DashboardAdmin.vue";
import NiveauAdmin from "./components/Admin/NiveauAdmin.vue";
import ViewNiveaux from "./components/Admin/ViewNiveaux.vue";

const routes = [
    {
        path: "/accueil",
        name: "dash",
        component: Dashboard
    },
    {
        path: "/niveau",
        name: "nivaus",
        component: NiveauAdmin
    },
    {
        path: "/afficher_niveaux",
        name: "nivaus",
        component: ViewNiveaux
    }
];

export default routes;
