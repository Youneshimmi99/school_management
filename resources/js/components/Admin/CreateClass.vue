<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fab fa-buromobelexperte"></i> Créer Une Classe
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Ajouter Classe</a>
          </li>
        </ol>
      </div>
    </div>
    <!-- <div class="d-flex justify-content-center">
      <div class="spinner-border" v-if="spinner" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>-->

    <!-- row -->
    <div v-if="errorCheck" class="alert alert-danger alert-dismissible fade show" role="alert">
      <ol>
        <li v-if="errors.nameClasse">{{ errors.nameClasse[0] }}</li>
        <li v-if="errors.IdGrade">{{ errors.IdGrade[0] }}</li>
        <li v-if="errors.Option_id">{{ errors.Option_id[0] }}</li>
        <li v-if="errors.number">{{ errors.number[0] }}</li>
      </ol>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Créer une classe</h4>
          </div>
          <div class="card-body">
            <div class="form-validation">
              <form class="form-valide" action="#" method="post">
                <div class="row mb-3">
                  <div class="col-lg-6">
                    <label class="text-dark">Classe</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="FormClasse.nameClasse"
                      placeholder="classe"
                    >
                  </div>
                  <div class="col-lg-6">
                    <label class="text-dark">Number</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="FormClasse.number"
                      placeholder="number"
                    >
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-lg-6">
                    <label class="text-dark">Cycle</label>
                    <select
                      class="form-control form-control"
                      @change="GetGrades(FormClasse.IdCyle)"
                      v-model="FormClasse.IdCyle"
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
                      @change="GetBranchs(FormClasse.IdGrade)"
                      v-model="FormClasse.IdGrade"
                    >
                      <option
                        v-for="(item,index) in GradesName"
                        :key="index"
                        :value="item.id"
                      >{{ item.name }}</option>
                    </select>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-lg-6">
                    <label class="text-dark">Option</label>
                    <select class="form-control form-control" v-model="FormClasse.Option_id">
                      <option
                        v-for="(item,index) in Subjects"
                        :key="index"
                        :value="item.id"
                      >{{ item.nameOption }}</option>
                    </select>
                  </div>

                  <div class="col-lg-6" v-if="this.FormClasse.IdCyle==3">
                    <label class="text-dark">branche</label>
                    <select class="form-control form-control" v-model="FormClasse.branch_id">
                      <option
                        v-for="(item,index) in BrancesName"
                        :key="index"
                        :value="item.id"
                      >{{ item.name }}</option>
                    </select>
                  </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                  <button type="button" @click="AddClasse" class="btn btn-primary btn-rounded">
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
</template>
<script>
export default {
  data() {
    return {
      add: true,
      addadmin: true,
      spinner: false,
      errorCheck: false,
      errors: [],
      Subjects: [],
      Cycles: [],
      GradesName: [],
      CyclesName: "",
      BrancesName: [],
      Options: [],
      nameClasse: "",
      FormClasse: {
        IdCyle: "",
        number: "",
        IdGrade: "",
        branch_id: "",
        Option_id: ""
      }
    };
  },
  methods: {
    // GitViewAddTechear() {
    //   this.spinner = true;
    //   setTimeout(() => {
    //     this.spinner = false;
    //     this.addadmin = true;
    //   }, 700);

    //   //   this.spinner = false;
    //   //   this.addadmin = true;
    // },

    GetSubjects() {
      this.Subjects = [];
      axios.get("/subjects").then(response => {
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
      axios.get("/grades/" + this.FormClasse.IdCyle).then(response => {
        if (response.data["status"] == "success") {
          this.GradesName = response.data["gradesname"];
          //   console.log(this.GradesName);
        }
      });
    },
    GetBranchs(item) {
      this.BrancesName = [];
      axios.get("/branches/" + this.FormClasse.IdGrade).then(response => {
        if (response.data["status"] == "success") {
          this.BrancesName = response.data["branchesnames"];
          //   console.log(this.GradesName);
        }
      });
    },
    AddClasse() {
      this.errors = [];
      this.errorCheck = false;
      axios
        .post("/class/add", this.FormClasse)
        .then(response => {
          if (response.data["status"] == "success") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Ajouté !",
              text: "Une classe a été enregistré",
              showConfirmButton: true
            });
          }
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
            // this.FromProf = [];
          }
        });
    }
  },
  created() {
    this.GetSubjects();
    this.GetCycles();
  }
};
</script>
