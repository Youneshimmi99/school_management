<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fas fa-user-graduate"></i> l'élève
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Ajouter l'élève</a>
          </li>
        </ol>
      </div>
    </div>
    <div class>
      <!-- <div class="d-flex justify-content-center">
        <div class="spinner-border" v-if="spinner" role="status">
          <span class="sr-only">Loading...</span>
        </div>
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
              <h4 class="card-title">Ajouter l'élève</h4>
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
                        v-model="Student.name"
                        placeholder="Saisie nom et prenom.."
                      >
                    </div>
                    <div class="col-lg-6">
                      <label class="text-dark">Mot de Passe</label>
                      <input
                        type="password"
                        v-model="Student.password"
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
                        v-model="Student.email"
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
                        v-model="Student.password2"
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
                        v-model="Student.tele"
                        id="val-username"
                        name="val-username"
                        placeholder="tele"
                      >
                    </div>
                    <!-- <div class="col-lg-6"> -->
                    <!-- <label class="text-dark">Matière</label>

                      <select class="form-control form-control" v-model="Student.subject_id">
                        <option
                          v-for="(item,index) in Subjects"
                          :key="index"
                          :value="item.id"
                        >{{ item.name }}</option>
                      </select>
                    </div>-->

                    <!-- <div class="col-lg-6">
                      <label class="text-dark">Cycle</label>
                      <select
                        class="form-control form-control"
                        @change="GetGrades(CyclesName)"
                        v-model="CyclesName"
                      >
                        <option
                          v-for="(item,index) in Cycles"
                          :key="index"
                          :value="item.name"
                        >{{ item.name }}</option>
                      </select>
                    </div>-->
                  </div>
                  <div class="row mt-3">
                    <!-- <div class="col-lg-6">
                      <label class="text-dark">Affectation des classes</label>

                      <select
                        class="multi-select-placeholder js-states"
                        multiple="multiple"
                        placeholder="Niveau"
                        v-model="ClasseProf"
                      >
                        <option>ewfew</option>
                        <option>sdfsdf</option>
                        <option>sdfsdf22</option>
                      </select>
                    </div>-->

                    <!-- <div class="col-lg-6" v-if="this.CyclesName=='Lycée'">
                      <label class="text-dark">branche</label>
                      <select class="form-control form-control">
                        <option>Small select</option>
                      </select>
                    </div>-->
                  </div>

                  <div class="d-flex justify-content-end mt-4">
                    <button type="button" @click="AddStudent" class="btn btn-primary btn-rounded">
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
    <!-- Large modal edit Student -->
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
                    v-model="Student.name"
                    placeholder="Saisie nom et prenom.."
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Mot de Passe</label>
                  <input
                    type="password"
                    v-model="Student.password"
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
                    v-model="Student.email"
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
                    v-model="Student.password2"
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
                    v-model="Student.tele"
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
              @click="UpdateStudent"
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
                style="color:black;text-align:center;"
              >
                <thead>
                  <tr>
                    <th scope="col">Profile</th>
                    <th scope="col">Nom et prenom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tele</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in AllStudent" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
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
                          @click="EditStudent(item.id)"
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
                          @click="DeleteStudent(item.id)"
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
      errorCheck: false,
      errors: [],
      Subjects: [],
      AllStudent: [],
      StudentLigne: [],
      Student: {
        name: "sacas",
        email: "scasc",
        tele: "cascas",
        password: "csascascas",
        password2: "csascascas"
      }
    };
  },
  methods: {
    AddStudent() {
      this.errors = [];
      this.errorCheck = false;
      axios
        .post("/addstudent", this.Student)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "L'eleve a été enregistré",
              showConfirmButton: true
            });

            this.GetStudent();
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
            this.errorCheck = true;
            this.errors = error.response.data.errors;
            alert;
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
    GetStudent() {
      this.AllStudent = [];
      axios.get("/students").then(response => {
        if (response.data["status"] == "success") {
          this.AllStudent = response.data["students"];
        }
      });
    },

    EditStudent(idStudent) {
      (this.Student.name = ""),
        (this.Student.email = ""),
        (this.Student.tele = ""),
        axios.get("/student/edit/" + idStudent).then(response => {
          if (response.data["status"] == "success") {
            this.StudentLigne = response.data["student"];
            this.Student.id = this.StudentLigne.id;
            this.Student.name = this.StudentLigne.name;
            this.Student.email = this.StudentLigne.email;
            this.Student.tele = this.StudentLigne.tele;
          }
        });
    },
    UpdateStudent(idStudent) {
      axios
        .post("/student/update", this.Student)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "modifié !",
              text: "L'enseignement a été modifier",
              showConfirmButton: true
            });

            this.GetStudent();
          }

          if (response.data["password"] == "error") {
            Swal.fire({
              position: "center",
              icon: "warning",
              title: "Error !",
              text: "Vos mot de passe  ne sont pas correctes !",
              showConfirmButton: true
            });
            this.Student = [];
          }
        })
        .catch(error => {
          if (error.response.status == 422) {
            this.errors = error.response.data.errors;
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
    DeleteStudent(idStudent) {
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
          axios.post("/delete/student/" + idStudent).then(response => {
            if (response.data["status"] == "success") {
              this.AllStudent = [];
              this.GetStudent();
            }
          });
          Swal.fire("Supprimé!", "L'enseignant a été supprimé.", "success");
        }
      });
    }
  },
  created() {
    this.GetStudent();
  }
};
</script>
