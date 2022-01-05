<template>
  <div class>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fab fa-buromobelexperte"></i> Affectation des classes
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Affectation</a>
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

      <!-- row -->
    </div>
    <!-- Large modal edit teacher -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Affectation des classes</h5>
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
                    disabled="disabled"
                    style="background-color:#40404024"
                    placeholder="Saisie nom et prenom.."
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>

                <div class="col-lg-6">
                  <label class="text-dark">Email</label>
                  <input
                    type="email"
                    disabled="disabled"
                    style="background-color:#40404024"
                    v-model="FromProf.email"
                    class="form-control"
                    id="val-email"
                    name="val-email"
                    placeholder="Saisie l'email"
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
                    disabled="disabled"
                    style="background-color:#40404024"
                    id="val-username"
                    name="val-username"
                    placeholder="tele"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Matière</label>

                  <select
                    class="form-control form-control"
                    v-model="FromProf.subject_id"
                    disabled="disabled"
                    style="background-color:#40404024"
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
              <div class="row mt-3">
                <div class="col-lg-6">
                  <label class="text-dark">Cycle</label>
                  <select
                    class="form-control form-control"
                    @change="GetGrades(IdCyle)"
                    v-model="IdCyle"
                    required
                  >
                    <option
                      v-for="(item,index) in Cycles"
                      :key="index"
                      :value="item.id"
                    >{{ item.name }}</option>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Niveau</label>
                  <select
                    class="form-control form-control"
                    @change="GetClass(IdGrade)"
                    v-model="IdGrade"
                    required
                  >
                    <option
                      v-for="(item,index) in GradesName"
                      :key="index"
                      :value="item.id"
                    >{{ item.name }}</option>
                  </select>
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-lg-6">
                  <div class="form-group" v-for="(input,k) in inputs" :key="k">
                    affecter une classe {{ k+1 }} au professeur
                    <!-- <input type="text" class="form-control" v-model="input.name"> -->
                    <select
                      class="form-control form-control"
                      placeholder="Niveau"
                      v-model="input.name"
                    >
                      <option
                        v-for="(item,index) in Classes"
                        :key="index"
                        :value="item.id"
                      >{{ item.nameClasse }}</option>
                    </select>
                    <span>
                      <i
                        class="fas fa-minus-circle"
                        @click="remove(k)"
                        v-show="k || ( !k && inputs.length > 1)"
                      >&ensp;Supprimer</i>
                      <i
                        class="fas fa-plus-circle"
                        @click="add(k)"
                        v-show="k == inputs.length-1"
                      >&ensp;Ajouter</i>
                    </span>
                  </div>
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
              @click="AddTeacherClasses"
            >Ajouter</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Affectation des classes</h4>
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
                    <th scope="col">Tele</th>
                    <th scope="col">Classes</th>
                    <!-- <th scope="col">Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in Teachers" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.namesub }}</td>
                    <td>{{ item.tele }}</td>
                    <td>
                      <h6>
                        <span
                          class="badge badge-secondary mr-1 deleteC"
                          v-for="(item2,index2) in TeachersClasses"
                          :key="index2"
                          @click="DeleteTeacher(item2.id)"
                        >
                          <span v-if="item.id==item2.teacher_id">{{ item2.nameClasse }}</span>
                        </span>
                        <i
                          @click="EditTeacher(item.id)"
                          class="fas fa-plus-circle"
                          data-toggle="modal"
                          data-target=".bd-example-modal-lg"
                          data-placement="top"
                        >&ensp;</i>
                      </h6>
                    </td>

                    <!--  <td>
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
                          <i class="fa fa-pencil color-muted"></i>
                        </a>
                        <a
                          href="javascript:void()"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Close"
                          @click="DeleteTeacher(item.id)"
                        >
                          <i class="fa fa-close color-danger"></i>
                        </a>
                      </span>
                    </td>-->
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
<style>
.icon {
  color: white;
  font-size: 100px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}
.deleteC:hover {
  background-color: red;
}
</style>

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
      IdCyle: "",
      IdGrade: "",
      IdClasse: [],
      TeachersClasses: [],
      FromProf: {
        name: "",
        subject_id: "",
        email: "",
        tele: ""
      },

      inputs: [
        {
          name: ""
        }
      ]
    };
  },
  methods: {
    AddTeacherClasses() {
      //   alert(this.inputs.length);

      //   alert(this.inputs[0]["name"]);
      axios
        .post("/add/classes/teacher", {
          FromProf: this.FromProf,
          IdClasse: this.inputs
        })
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "la classe a été affecter",
              showConfirmButton: true
            });
            // this.Cycles = [];
            // this.GetCycles();
            // this.FromProf = [];
            // this.ClasseProf = [];
            // this.GradesName = [];
            // for (let index = 0; index < this.inputs.length; index++) {
            //   this.inputs[index]["name"] = "";
            // }
            this.addadmin = false;
          }
          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "warning",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            }).catch(error => {
              if (error.response.status == 422) {
                Swal.fire({
                  position: "center",
                  icon: "error",
                  title: "Error !",
                  text: "Tous les champs c'est obligatoire !",
                  showConfirmButton: true
                });
                this.FromProf = [];
              }
              if (error.response.status == 500) {
                Swal.fire({
                  position: "center",
                  icon: "error",
                  title: "Error !",
                  text: "Tous les champs c'est obligatoire !",
                  showConfirmButton: true
                });
              }
            });
          }

          this.Teachers = [];
          this.GetTeachers();
        });
    },
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
      axios
        .post("/add/prof", {
          FromProf: this.FromProf,
          IdClasse: this.inputs
        })
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "L'enseignement a été enregistré",
              showConfirmButton: true
            });
            this.FromProf = [];
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
            }).catch(error => {
              if (error.response.status == 422) {
                Swal.fire({
                  position: "center",
                  icon: "error",
                  title: "Error !",
                  text: "Tous les champs c'est obligatoire !",
                  showConfirmButton: true
                });
                this.FromProf = [];
              }
              if (error.response.status == 500) {
                Swal.fire({
                  position: "center",
                  icon: "error",
                  title: "Error !",
                  text: "Tous les champs c'est obligatoire !",
                  showConfirmButton: true
                });
              }
            });
          }

          this.Teachers = [];
          this.GetTeachers();
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
      // this.Classes = [];
      axios.get("/getclassesbyid/" + IdGrade).then(response => {
        if (response.data["status"] == "success") {
          this.Classes = response.data["classes"];
          // alert(this.Classes);
        }
      });
    },
    GetTeachers() {
      this.Teachers = [];
      axios.get("/teachers/classes").then(response => {
        if (response.data["status"] == "success") {
          this.Teachers = response.data["teachers"];
          this.TeachersClasses = response.data["teacher_classes"];
        }
      });
    },
    EditTeacher(idTeacher) {
      this.spinner = true;
      setTimeout(() => {
        this.spinner = false;
        this.addadmin = true;
      }, 700);
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
            this.Teachers = [];
            this.GetTeachers();
            this.FromProf = [];
          }
          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "warning",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            });
            this.FromProf = [];
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
            this.FromProf = [];
          }
        });
    },
    DeleteTeacher(IdClasseClique) {
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
          axios
            .post("/delete/teacher/classe/" + IdClasseClique)
            .then(response => {
              if (response.data["status"] == "success") {
                this.Teachers = [];
                this.TeachersClasses = [];
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
