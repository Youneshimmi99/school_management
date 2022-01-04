<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fas fa-calendar-plus"></i> L'absences
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">L'absences</a>
          </li>
        </ol>
      </div>
    </div>

    <div class="d-flex justify-content-end">
      <button
        type="button"
        data-toggle="modal"
        data-target=".bd-example-modal-lg"
        data-placement="top"
        @click="GetTeachers"
        class="btn btn-primary btn-rounded mb-3"
      >
        <i class="fa fa-plus color-primary"></i>&ensp;Ajouter l'absence
      </button>
    </div>
    <!-- Large modal edit Student -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter l'absense</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate>
              <div class="row">
                <div class="col-lg-4">
                  <label for>Professeur</label>
                  <select class="form-control" v-model="AbsenceTeacher.teacher_id">
                    <option
                      v-for="(item,index) in Teachers"
                      :key="index"
                      :value="item.id"
                    >{{ item.id }}&ensp;|&ensp;{{ item.name }}</option>
                  </select>
                </div>
                <div class="col-lg-4">
                  <label for>Date de début</label>
                  <input
                    type="date"
                    v-model="AbsenceTeacher.start_date"
                    class="form-control"
                    id="val-date"
                    name="val-date"
                  >
                </div>
                <div class="col-lg-4">
                  <label for>Date de fin</label>
                  <input
                    type="date"
                    v-model="AbsenceTeacher.end_date"
                    class="form-control"
                    id="val-date"
                    name="val-date"
                  >
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-times"></i>&ensp;Annuler
            </button>
            <button
              type="button"
              @click="CreateAbsence"
              class="btn btn-primary"
              data-dismiss="modal"
            >
              <i class="fa fa-plus color-primary"></i>&ensp;Ajouter
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Large modal edit L'absence teacher -->
    <div class="modal fade bd-absence-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifier l'absense</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" novalidate>
              <div class="row">
                <div class="col-lg-4">
                  <label for>Professeur</label>
                  <input
                    type="text"
                    disabled="disabled"
                    style="background-color:#40404024"
                    v-model="AbsenceTeacher.teacher_id"
                    class="form-control"
                    id="val-date"
                    name="val-date"
                  >
                </div>
                <div class="col-lg-4">
                  <label for>Date de début</label>
                  <input
                    type="date"
                    v-model="AbsenceTeacher.start_date"
                    class="form-control"
                    id="val-date"
                    name="val-date"
                  >
                </div>
                <div class="col-lg-4">
                  <label for>Date de fin</label>
                  <input
                    type="date"
                    v-model="AbsenceTeacher.end_date"
                    class="form-control"
                    id="val-date"
                    name="val-date"
                  >
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-times"></i>&ensp;Annuler
            </button>
            <button
              type="button"
              @click="UpdateAbsenceTeacher"
              class="btn btn-primary"
              data-dismiss="modal"
            >
              <i class="fa fa-plus color-primary"></i>&ensp;Modifier
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">L'absence</h4>
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
                    <th scope="col">Date de début</th>
                    <th scope="col">Date de fin</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in Absences" :key="index">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.namesub }}</td>
                    <td>{{ item.tele }}</td>
                    <td>{{ item.start_date }}</td>
                    <td>{{ item.end_date }}</td>
                    <td>
                      <span>
                        <a
                          href="javascript:void()"
                          class="mr-4"
                          data-toggle="modal"
                          data-target=".bd-absence-modal-lg"
                          data-placement="top"
                          title="Edit"
                          @click="EditAbsenceTeacher(item.id)"
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
      Teachers: [],
      Absences: [],
      EditAbsencex: [],
      IdTeacherAbsence: "",
      AbsenceTeacher: {
        teacher_id: "",
        start_date: "",
        end_date: ""
      }
    };
  },
  methods: {
    DeleteAdmin(idteacherAbsence) {
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
            .post("/teacher_absence/destroy/" + idteacherAbsence)
            .then(response => {
              if (response.data["status"] == "success") {
                // this.Alladmins = [];
                this.GetAbsencesTeacher();
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
    },
    EditAbsenceTeacher(idTeacherAbsence) {
      (this.AbsenceTeacher.teacher_id = ""),
        (this.AbsenceTeacher.start_date = ""),
        (this.AbsenceTeacher.end_date = ""),
        // (this.EditAbsencex = []);
        (this.IdTeacherAbsence = "");
      axios.get("/teacher_absence/" + idTeacherAbsence).then(response => {
        if (response.data["status"] == "success") {
          this.EditAbsencex = response.data["teacher_absence"];
          this.IdTeacherAbsence = this.EditAbsencex[0]["id"];
          this.AbsenceTeacher.teacher_id = this.EditAbsencex[0]["teacher_id"];
          this.AbsenceTeacher.start_date = this.EditAbsencex[0]["start_date"];
          this.AbsenceTeacher.end_date = this.EditAbsencex[0]["end_date"];
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
    GetAbsencesTeacher() {
      this.Absences = [];
      axios.get("/teacher_absences").then(response => {
        if (response.data["status"] == "success") {
          this.Absences = response.data["teacher_absences"];
        }
      });
    },
    UpdateAbsenceTeacher() {
      axios
        .post(
          "/update/teacher/absence/" + this.IdTeacherAbsence,
          this.AbsenceTeacher
        )
        .then(response => {
          if (response.data["status"] == "success") {
            this.GetAbsencesTeacher();
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "la classe a été affecter",
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
            this.FromProf = [];
          }
        });
    },
    CreateAbsence() {
      axios
        .post("/teacher_absences", this.AbsenceTeacher)
        .then(response => {
          if (response.data["status"] == "success") {
            this.GetAbsencesTeacher();
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "L'absence a été enregistré",
              showConfirmButton: true
            });
            this.AbsenceTeacher = [];
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
          }
        });
    }
  },
  created() {
    this.GetAbsencesTeacher();
  }
};
</script>