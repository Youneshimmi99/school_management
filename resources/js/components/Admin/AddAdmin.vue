<template>
  <div class>
    <div class>
      <div class="row page-titles mx-0">
        <div class="col-sm-12s p-md-0">
          <div class="welcome-text">
            <h4>Hi, welcome back!</h4>
            <p class="mb-1">Validation</p>
          </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-1 mt-sm-0 d-flex">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="javascript:void(0)">Form</a>
            </li>
            <li class="breadcrumb-item active">
              <a href="javascript:void(0)">Validation</a>
            </li>
          </ol>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <div class="spinner-border" v-if="spinner" role="status">
          <span class="sr-only">Loading...</span>
        </div>
      </div>

      <div class="d-flex justify-content-end mb-2">
        <button type="button" @click="GitViewAddTechear" class="btn btn-primary">Ajouter Admin</button>
      </div>

      <!-- row -->
      <div class="row" v-if="addadmin">
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
                        v-model="this.FromAdmin.name"
                        placeholder="Saisie nom et prenom.."
                      >
                    </div>
                    <div class="col-lg-6">
                      <label class="text-dark">Mot de Passe</label>
                      <input
                        type="password"
                        v-model="this.FromAdmin.password"
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
                        v-model="this.FromAdmin.email"
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
                        v-model="this.FromAdmin.password2"
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
                        v-model="this.FromAdmin.tele"
                        id="val-username"
                        name="val-username"
                        placeholder="tele"
                      >
                    </div>
                    <!-- <div class="col-lg-6"> -->
                    <!-- <label class="text-dark">Matière</label>

                      <select class="form-control form-control" v-model="FromAdmin.subject_id">
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
                    <button type="button" @click="AddAdmin" class="btn btn-primary">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
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
                    <th scope="col">Email</th>
                    <th scope="col">Tele</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in Admins" :key="index">
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
      Subjects: [],
      Admins: [],
      FromAdmin: {
        name: "sacas",
        email: "scasc",
        tele: "cascas",
        password: "csascascas",
        password2: "csascascas"
      }
    };
  },
  methods: {
    AddAdmin() {
      axios.post("/add/admin", this.FromAdmin).then(response => {
        console.log("test");
      });
    },
    GetAllAdmins() {
      axios.get("/get/admins").then(response => {
        if (response.data["status"] == "success") {
          this.admins = response.data["admins"];
          console.log(this.admins);
        }
      });
    },
    EditTeacher() {},
    DeleteTeacher() {}
  },
  created() {
    this.GetAllAdmins();
  }
};
</script>
