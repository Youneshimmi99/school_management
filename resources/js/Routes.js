import Dashboard from "./components/Admin/DashboardAdmin.vue";
import NiveauAdmin from "./components/Admin/NiveauAdmin.vue";
import ViewNiveaux from "./components/Admin/ViewNiveaux.vue";
import AddTechear from "./components/Admin/AddTechear.vue";
import CreateClass from "./components/Admin/CreateClass.vue";
import ViewClass from "./components/Admin/ViewClass.vue";

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
    },
    {
        path: "/ajouter_professeur",
        name: "ajouter_prof",
        component: AddTechear
    },
    {
        path: "/creer_classe",
        name: "creer_classe",
        component: CreateClass
    },
    {
        path: "/classes",
        name: "classes",
        component: ViewClass
    }
];

export default routes;
