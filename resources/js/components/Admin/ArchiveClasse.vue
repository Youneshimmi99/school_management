<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fab fa-buromobelexperte"></i> Les classes archives
          </span>
        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Accueil</a>
          </li>
          <li class="breadcrumb-item active">
            <a href="javascript:void(0)">Archives</a>
          </li>
        </ol>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Les lasses archives</h4>
            <div class="float-right col-lg-4">
              <!-- <label class="text-dark">Cycle</label> -->
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm"
                style="color:black;text-align:center;"
              >
                <thead>
                  <tr>
                    <th scope="col">Classe</th>
                    <th scope="col">Number</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Option</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in ClassesArchives" :key="index">
                    <td>{{ item.nameClasse }}</td>
                    <td>{{ item.numberCls }}</td>
                    <td>{{ item.nameGrade }}</td>
                    <td>{{ item.nameOption }}</td>
                    <td>
                      <span>
                        <a
                          href="javascript:void()"
                          class="mr-4"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Edit"
                          @click="Restore(item.id)"
                        >
                          <span class="badge badge-info">
                            <i class="fas fa-trash-restore"></i>
                            <span>&ensp;Restore</span>
                          </span>
                        </a>
                        <a
                          href="javascript:void()"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Close"
                          @click="DeleteForce(item.id)"
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
// ES6 Modules or TypeScript
import Swal from "sweetalert2/dist/sweetalert2.js";
import "sweetalert2/src/sweetalert2.scss";
export default {
  data() {
    return {
      ClassesArchives: [],
      Cycles: [],
      IdCycle: ""
    };
  },
  methods: {
    GetClass() {
      axios.get("/classe/archive").then(response => {
        if (response.data["status"] == "success") {
          this.ClassesArchives = response.data["classes"];
        }
      });
    },
    DeleteForce(idClasse) {
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
          axios.post("/classe/destroy/" + idClasse).then(response => {
            if (response.data["status"] == "success") {
              this.ClassesArchives = [];
              this.GetClass();
            }
          });
          Swal.fire("Supprimé!", "L'enseignant a été supprimé.", "success");
        }
      });
    },
    Restore(idClasse) {
      axios.post("/classe/restore/" + idClasse).then(response => {
        if (response.data["status"] == "success") {
          this.ClassesArchives = [];
          this.GetClass();
        }
      });
    }
  },
  created() {
    this.GetClass();
  }
};
</script>
