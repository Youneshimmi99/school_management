<template>
  <div class>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader" >
            <i class="fas fa-chalkboard-teacher"></i> Professeur
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Ajouter Professeur</a>
          </li>
        </ol>
      </div>
    </div>
    <div class>
      <div class="d-flex justify-content-center">
        <div class="spinner-border" v-if="spinner" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div v-if="errorCheck" class="alert alert-danger alert-dismissible fade show" role="alert">
        <ol>
          <li v-if="errors.name">{{ errors.name[0] }}</li>
          <li v-if="errors.email">{{ errors.email[0] }}</li>
          <li v-if="errors.password">{{ errors.password[0] }}</li>
          <li v-if="errors.subject_id">{{ errors.subject_id[0] }}</li>
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
              <h4 class="card-title">Ajouter Professeur</h4>
            </div>
            <div class="card-body">
              <div class="form-validation">
                <form class="needs-validation" novalidate>
                  <div class="row mb-3">
                    <div class="col-lg-6">
                      <label class="text-dark">Nom et Prenom</label>
                      <input
                        type="text"
                        class="form-control"
                        id="val-username"
                        name="val-username"
                        v-model="FromProf.name"
                        placeholder="Saisie nom et prenom.."
                        required
                      >
                      <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                    </div>
                    <div class="col-lg-6">
                      <label class="text-dark">Mot de Passe</label>
                      <input
                        type="password"
                        v-model="FromProf.password"
                        class="form-control"
                        id="val-username"
                        name="val-username"
                        placeholder="Saisie le mot de passe"
                        required
                      >
                      <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <label class="text-dark">Email</label>
                      <input
                        type="email"
                        v-model="FromProf.email"
                        class="form-control"
                        id="val-email"
                        name="val-email"
                        placeholder="Saisie l'email"
                        required
                      >
                      <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                    </div>

                    <div class="col-lg-6">
                      <label class="text-dark">Confirmer mot de passe</label>
                      <input
                        type="password"
                        class="form-control"
                        v-model="FromProf.password2"
                        id="val-username"
                        name="val-username"
                        placeholder="confirmer mot de passe"
                        required
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
                        v-model="FromProf.tele"
                        id="val-username"
                        name="val-username"
                        placeholder="tele"
                        required
                      >
                      <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                    </div>
                    <div class="col-lg-6">
                      <label class="text-dark">Matière</label>

                      <select
                        class="form-control form-control"
                        v-model="FromProf.subject_id"
                        required
                      >
                        <option
                          v-for="(item,index) in Subjects"
                          :key="index"
                          :value="item.id"
                        >{{ item.namesub }}</option>
                      </select>
                      <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end mt-4">
                    <button type="button" @click="AddProf" class="btn btn-primary btn-rounded">
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
                    v-model="FromProf.name"
                    placeholder="Saisie nom et prenom.."
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Mot de Passe</label>
                  <input
                    type="password"
                    v-model="FromProf.password"
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
                    v-model="FromProf.email"
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
                    v-model="FromProf.password2"
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
                    v-model="FromProf.tele"
                    id="val-username"
                    name="val-username"
                    placeholder="tele"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Matière</label>

                  <select class="form-control form-control" v-model="FromProf.subject_id">
                    <option
                      v-for="(item,index) in Subjects"
                      :key="index"
                      :value="item.id"
                    >{{ item.namesub }}</option>
                  </select>
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
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Les enseignants</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm"
                style="color:black"
              >
                <thead>
                  <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Nom et prenom</th>
                    <th scope="col">Matière</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tele</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in Teachers" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.namesub }}</td>
                    <td>{{ item.email }}</td>
                    <td>{{ item.tele }}</td>
                    <td>
                      <span>
                        <a
                          href="javascript:void()"
                          class="mr-4"
                          data-toggle="modal"
                          data-target=".bd-example-modal-lg"
                          data-placement="top"
                          title="Edit"
                          @click="EditTeacher(item.id)"
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
                          @click="DeleteTeacher(item.id)"
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
(function() {
  "use strict";
  window.addEventListener(
    "load",
    function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName("needs-validation");
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener(
          "button",
          function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
          },
          false
        );
      });
    },
    false
  );
})();
// ES6 Modules or TypeScript
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      addadmin: true,
      spinner: false,
      Subjects: [],
      Cycles: [],
      GradesName: [],
      ClasseProf: [],
      BranchesName: [],
      Classes: [],
      Teachers: [],
      TeachersIdit: [],
      errorCheck: false,
      errors: [],
      IdCyle: "",
      IdGrade: "",
      IdClasse: [],
      FromProf: {
        name: "test1",
        subject_id: "",
        email: "sacascasc@gmail.com",
        tele: "34234324",
        password: "12345678",
        password2: "12345678"
      },

      inputs: [
        {
          name: ""
        }
      ]
    };
  },
  methods: {
    add(index) {
      this.inputs.push({ name: "" });
    },
    remove(index) {
      this.inputs.splice(index, 1);
    },
    GitViewAddTechear() {
      this.spinner = true;
      setTimeout(() => {
        this.spinner = false;
        this.addadmin = true;
      }, 700);
    },
    AddProf() {
      this.errors = [];
      this.errorCheck = false;
      axios
        .post("/add/prof", this.FromProf)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "L'enseignement a été enregistré",
              showConfirmButton: true
            });
            // this.FromProf = [];
            this.ClasseProf = [];
            this.addadmin = false;
          }
          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "warning",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            });
          }

          this.Teachers = [];
          this.GetTeachers();
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
            this.errorCheck = true;
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
    GetSubjects() {
      this.Subjects = [];
      axios.get("/subjectsprof").then(response => {
        if (response.data["status"] == "success") {
          this.Subjects = response.data["subjects"];
        }
      });
    },
    GetCycles() {
      this.Cycles = [];
      axios.get("/cycles").then(response => {
        if (response.data["status"] == "success") {
          this.Cycles = response.data["cycles"];
        }
      });
    },
    GetGrades(item) {
      this.GradesName = [];

      axios.get("/grades/" + this.IdCyle).then(response => {
        if (response.data["status"] == "success") {
          this.GradesName = response.data["gradesname"];
          //   console.log(this.GradesName);
        }
      });
    },
    GetClass(IdGrade) {
      // alert(this.IdGrade);
      this.Classes = [];
      axios.get("/getclassesbyid/" + IdGrade).then(response => {
        if (response.data["status"] == "success") {
          this.Classes = response.data["classes"];

          // alert(this.Classes);
        }
      });
    },
    GetTeachers() {
      this.Teachers = [];
      axios.get("/teachers").then(response => {
        if (response.data["status"] == "success") {
          this.Teachers = response.data["teachers"];
        }
      });
    },
    EditTeacher(idTeacher) {
      (this.FromProf.name = ""),
        (this.FromProf.subject_id = ""),
        (this.FromProf.email = ""),
        (this.FromProf.tele = ""),
        axios.get("/teachers/edit/" + idTeacher).then(response => {
          if (response.data["status"] == "success") {
            this.TeachersIdit = response.data["teachers"];
            this.FromProf.id = this.TeachersIdit.id;
            this.FromProf.name = this.TeachersIdit.name;
            this.FromProf.subject_id = this.TeachersIdit.subject_id;
            this.FromProf.email = this.TeachersIdit.email;
            this.FromProf.tele = this.TeachersIdit.tele;
            this.FromProf.password = "";
            this.FromProf.password2 = "";
          }
        });
    },
    UpdateTeacher() {
      axios
        .post("/teachers/update", this.FromProf)
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

            this.GetTeachers();
          }
          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "warning",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            });
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
    DeleteTeacher(IdTeacher) {
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
          axios.post("/delete/teacher/" + IdTeacher).then(response => {
            if (response.data["status"] == "success") {
              this.Teachers = [];
              this.GetTeachers();
            }
          });
          Swal.fire("Supprimé!", "L'enseignant a été supprimé.", "success");
        }
      });
    }
  },
  created() {
    this.GetSubjects();
    this.GetCycles();
    this.GetTeachers();
  }
};
</script>
