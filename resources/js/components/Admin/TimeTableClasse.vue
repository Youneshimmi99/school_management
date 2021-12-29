<template>
  <div>
    <!-- Large modal ajouter classe -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Ajouter L'emploi de temps Classe</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="needs-validation" novalidate>
              <div class="row mb-3">
                <div class="col-lg-6">
                  <label class="text-dark">Nom L'emploi de temps</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="Timetables.NameTimeTable"
                    id="val-timetable"
                    name="val-timetable"
                    placeholder="Nom L'emploi de temps"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Ficher</label>
                  <input
                    type="file"
                    class="form-control"
                    id="file"
                    ref="file"
                    v-on:change="handleFileUpload()"
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>
              <!-- <div class="row mb-3">
                <div class="col-lg-6">
                  <label class="text-dark">Niveau</label>

                  <select class="form-control form-control" v-model="IdClasse">
                    <option
                      v-for="(item,index) in TeachersCla"
                      :key="index"
                      :value="item.id"
                    >{{ item.nameClasse }}</option>
                  </select>
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
              </div>-->

              <div class="row mt-3">
                <div class="col-lg-6">
                  <label class="text-dark">Classe</label>
                  <input
                    type="text"
                    class="form-control"
                    name="val-nameclass"
                    style="background-color:#40404024"
                    v-model="ClassesInfo.name"
                    disabled
                  >
                  <div class="invalid-feedback">cette champs ç'est obligatoire*</div>
                </div>
                <div class="col-lg-6">
                  <label class="text-dark">Number classe</label>
                  <input
                    type="text"
                    class="form-control"
                    name="val-nameclass"
                    style="background-color:#40404024"
                    v-model="ClassesInfo.numberCls"
                    disabled
                  >
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button
              data-dismiss="modal"
              type="button"
              class="btn btn-primary"
              @click="CreateTimeTableClasse(ClassesInfo.id)"
            >Ajouter</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Ajouter L'emploi de temps Classe</h4>
          </div>
          <div class="card-body">
            <div class="row">
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
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Aucun emploi de temps</h4>
              </div>
              <div class="card-body">
                <h6>
                  <span
                    class="badge badge-secondary mr-1 deleteC"
                    v-for="(item,index) in ClassesNoTimeTable"
                    :key="index"
                  >
                    <span
                      href="javascript:void()"
                      data-toggle="modal"
                      data-target=".bd-example-modal-lg"
                      data-placement="top"
                      @click="GetClassesInfo(item.id)"
                    >{{ item.nameClasse }}</span>
                  </span>
                </h6>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Calendrier téléchargé avec succès</h4>
              </div>
              <div class="card-body">
                <h6>
                  <span
                    class="badge badge-info mr-1 deleteC"
                    v-for="(item,index) in Classes"
                    :key="index"
                  >
                    <span @click="DeleteTimeTableClasse(item.id)">{{ item.id }}</span>
                  </span>
                </h6>
              </div>
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
      IdCyle: "",
      IdGrade: "",
      timetablesappend: new FormData(),
      Cycles: [],
      GradesName: [],
      Classes: [],
      errors: [],
      ClassesNoTimeTable: [],
      InfoClassSelect: [],
      ClassesInfo: {
        id: "",
        name: "",
        numberCls: ""
      },
      Timetables: {
        File: "",
        NameTimeTable: ""
      }
    };
  },
  methods: {
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
    GetClass(idd) {
      axios
        .get("/getclassesbyid/notimeTable/" + this.IdGrade)
        .then(response => {
          if (response.data["status"] == "success") {
            this.Classes = response.data["classesTimeTblesuccess"];
            this.ClassesNoTimeTable = response.data["classesTimeTblePending"];
            // alert(this.Classes);
            //   console.log(this.Classes);
          }
        });
    },

    GetClassesInfo(Idclasse) {
      this.InfoClassSelect = [];
      axios.get("/getclassesInfo/" + Idclasse).then(response => {
        if (response.data["status"] == "success") {
          this.InfoClassSelect = response.data["classeinfo"];
          this.ClassesInfo.id = this.InfoClassSelect.id;
          this.ClassesInfo.name = this.InfoClassSelect.nameClasse;
          this.ClassesInfo.numberCls = this.InfoClassSelect.numberCls;
          //   console.log(InfoClassSelect);
        }
      });
    },
    handleFileUpload() {
      this.Timetables.File = this.$refs.file.files[0];
      //   console.log(this.Timetables.File);
    },
    CreateTimeTableClasse(Idclasse) {
      const config = { headers: { "Content-Type": "multipart/form-data" } };

      this.timetablesappend.append("file", this.Timetables.File);
      this.timetablesappend.append(
        "nameTimetable",
        this.Timetables.NameTimeTable
      );
      this.timetablesappend.append("classe_id", Idclasse);

      axios
        .post("/timetable/classe", this.timetablesappend, config)
        .then(response => {
          if (response.data["status"] == "success") {
            this.GetClass();
            this.Timetables.File = "";
            this.Timetables.NameTimeTable = "";
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "L'emploi de temps a été enregistré",
              showConfirmButton: true
            });
            // commentsRemovedSec2.push(this.timetablesappend);
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
    DeleteTimeTableClasse(idClase) {
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
          axios.post("/delete/timetable/classe/" + idClase).then(response => {
            if (response.data["status"] == "success") {
              this.Classes = [];
              this.ClassesNoTimeTable = [];
              this.GetClass();
            }
          });
          Swal.fire(
            "Supprimé!",
            "L'emploi de temps a été supprimé.",
            "success"
          );
        }
      });
    }
  },
  created() {
    this.GetCycles();
  }
};
</script>
