<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fas fa-users-cog"></i> Admin
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Ajouter admin</a>
          </li>
        </ol>
      </div>
    </div>
    <!-- Large modal edit teacher -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate>
              <div class="row mb-3">
                <div class="col-lg-6">
                  <label class="text-dark">Nom et Prenom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="val-username"
                    name="val-username"
                    v-model="FromAdmin.name"
                    placeholder="Saisie nom et prenom.."
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Mot de Passe</label>
                  <input
                    type="password"
                    v-model="FromAdmin.password"
                    class="form-control"
                    id="val-username"
                    name="val-username"
                    placeholder="Saisie le mot de passe"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <label class="text-dark">Email</label>
                  <input
                    type="email"
                    v-model="FromAdmin.email"
                    class="form-control"
                    id="val-email"
                    name="val-email"
                    placeholder="Saisie l'email"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>

                <div class="col-lg-6">
                  <label class="text-dark">Confirmer mot de passe</label>
                  <input
                    type="password"
                    class="form-control"
                    v-model="FromAdmin.password2"
                    id="pass"
                    name="pass"
                    placeholder="confirmer mot de passe"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-6">
                  <label class="text-dark">Tele</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="FromAdmin.tele"
                    id="val-username"
                    name="val-username"
                    placeholder="tele"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button
              type="button"
              class="btn btn-primary"
              data-dismiss="modal"
              @click="UpdateTeacher"
            >Modifier</button>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="d-flex justify-content-center">
        <div class="spinner-border" v-if="spinner" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

      <!-- <div class="d-flex justify-content-end mb-2">
        <button type="button" class="btn btn-primary">Ajouter Admin</button>
      </div>-->

      <div v-if="errorCheck" class="alert alert-danger alert-dismissible fade show" role="alert">
        <ol>
          <li v-if="errors.name">{{ errors.name[0] }}</li>
          <li v-if="errors.email">{{ errors.email[0] }}</li>
          <li v-if="errors.password">{{ errors.password[0] }}</li>
          <li v-if="errors.tele">{{ errors.tele[0] }}</li>
        </ol>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Ajouter Admin</h4>
            </div>
            <div class="card-body">
              <div class="form-validation">
                <form class="form-valide" action="#" method="post">
                  <div class="row mb-3">
                    <div class="col-lg-6">
                      <label class="text-dark">Nom et Prenom</label>
                      <input
                        type="text"
                        class="form-control"
                        id="val-username"
                        name="val-username"
                        v-model="FromAdmin.name"
                        placeholder="Saisie nom et prenom.."
                      >
                    </div>
                    <div class="col-lg-6">
                      <label class="text-dark">Mot de Passe</label>
                      <input
                        type="password"
                        v-model="FromAdmin.password"
                        class="form-control"
                        id="val-username"
                        name="val-username"
                        placeholder="Saisie le mot de passe"
                      >
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <label class="text-dark">Email</label>
                      <input
                        type="email"
                        v-model="FromAdmin.email"
                        class="form-control"
                        id="val-email"
                        name="val-email"
                        placeholder="Saisie l'email"
                      >
                    </div>

                    <div class="col-lg-6">
                      <label class="text-dark">Confirmer mot de passe</label>
                      <input
                        type="password"
                        class="form-control"
                        v-model="FromAdmin.password2"
                        id="val-username"
                        name="val-username"
                        placeholder="confirmer mot de passe"
                      >
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-lg-6">
                      <label class="text-dark">Tele</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="FromAdmin.tele"
                        id="val-username"
                        name="val-username"
                        placeholder="tele"
                      >
                    </div>
                  </div>

                  <div class="d-flex justify-content-end mt-4">
                    <button type="button" @click="AddAdmin" class="btn btn-primary btn-rounded">
                      <i class="fa fa-plus color-primary"></i>&ensp;Ajouter
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- {{ this.Alladmins }} -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Admins</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm"
                style="color:black;text-align:center;"
              >
                <thead>
                  <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Nom et prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tele</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in Alladmins" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.tele }}</td>
                    <td>
                      <span v-if="IdAdmin== item.id" class="badge badge-success">connecté</span>
                      <span v-else class="badge badge-danger">déconnecter</span>
                    </td>
                    <td>
                      <span>
                        <a
                          href="javascript:void()"
                          class="mr-4"
                          data-toggle="modal"
                          data-target=".bd-example-modal-lg"
                          data-placement="top"
                          title="Edit"
                          @click="EditAdmin(item.id)"
                        >
                          <span class="badge badge-info">
                            <i class="fa fa-pencil color-muted"></i>
                            <span>&ensp;Modifier</span>
                          </span>
                        </a>
                        <a
                          href="javascript:void()"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Close"
                          @click="DeleteAdmin(item.id)"
                        >
                          <span class="badge badge-danger">
                            <i class="far fa-trash-alt"></i>
                            <span>&ensp;Supprimer</span>
                          </span>
                        </a>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      addadmin: true,
      spinner: false,
      IdAdmin: "",
      Subjects: [],
      Alladmins: [],
      AdminEdit: [],
      errorCheck: false,
      AdminActive: [],
      errors: [],
      FromAdmin: {
        name: "",
        email: "",
        tele: "",
        password: "",
        password2: ""
      }
    };
  },
  methods: {
    getAdminActive() {
      axios.get("/adminactive").then(response => {
        if (response.data["status"] == "success") {
          this.AdminActive = response.data["adminactive"];
        }
      });
    },
    AddAdmin() {
      this.errors = [];
      this.errorCheck = false;
      axios
        .post("/add/admin", this.FromAdmin)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "L'admin a été enregistré",
              showConfirmButton: true
            });
            this.GetAllAdmins();
          }
          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            });
          }
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
            this.errorCheck = true;
            console.log(this.errors);
            Swal.fire({
              position: "center",
              icon: "error",
              title: "Error !",
              text: "Tous les champs c'est obligatoire !",
              showConfirmButton: true
            });
          }
        });
    },
    GetAllAdmins() {
      axios.get("/get/admins").then(response => {
        if (response.data["status"] == "success") {
          this.Alladmins = [];
          this.Alladmins = response.data["admins"];
          this.IdAdmin = response.data["idadmin"];
          // console.log(this.Alladmins);
        }
      });
    },
    EditAdmin(idTeacher) {
      (this.FromAdmin.name = ""),
        (this.FromAdmin.email = ""),
        (this.FromAdmin.tele = ""),
        axios.get("/admin/edit/" + idTeacher).then(response => {
          if (response.data["status"] == "success") {
            this.AdminEdit = response.data["editadmin"];
            this.FromAdmin.id = this.AdminEdit.id;
            this.FromAdmin.name = this.AdminEdit.name;
            this.FromAdmin.email = this.AdminEdit.email;
            this.FromAdmin.tele = this.AdminEdit.tele;
            this.FromAdmin.password = "";
            this.FromAdmin.password2 = "";
          }
        });
    },
    UpdateTeacher() {
      axios
        .post("/admin/update", this.FromAdmin)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "modifié !",
              text: "L'enseignement a été modifier",
              showConfirmButton: false,
              timer: 1900
            });

            this.GetAllAdmins();
          }
          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "warning",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            });
            // this.FromProf = [];
          }
        })
        .catch(error => {
          if (error.response.status == 422) {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "Error !",
              text: "Tous les champs c'est obligatoire !",
              showConfirmButton: true
            });
            // this.FromProf = [];
          }
        });
    },
    DeleteAdmin(idadmin) {
      Swal.fire({
        title: "Es-tu sûr?",
        text: "Vous ne pourrez pas revenir en arrière !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Annuler",
        confirmButtonText: "Oui, supprimez-le !"
      }).then(result => {
        if (result.isConfirmed) {
          axios.post("/delete/admin/" + idadmin).then(response => {
            if (response.data["status"] == "success") {
              this.Alladmins = [];
              this.GetAllAdmins();
            }
            if (response.data["status"] == "impossible") {
              Swal.fire({
                position: "center",
                icon: "error",
                title: "Error !",
                text: "Impossible supprimer votre compte",
                showConfirmButton: true
              });
            }
          });
          Swal.fire("Supprimé!", "L'enseignant a été supprimé.", "success");
        }
      });
    }
  },
  created() {
    this.GetAllAdmins();
    this.getAdminActive();
  }
};
</script>
