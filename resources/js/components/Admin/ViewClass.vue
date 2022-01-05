<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Classes</h4>
          <div class="float-right col-lg-4">
            <!-- <label class="text-dark">Cycle</label> -->
            <select class="form-control form-control" @change="GetClass(IdCycle)" v-model="IdCycle">
              <option v-for="(item,index) in Cycles" :key="index" :value="item.id">{{ item.name }}</option>
            </select>
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
                  <th scope="col">Branche</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item,index) in Classes" :key="index">
                  <td>{{ item.nameClasse }}</td>
                  <td>{{ item.numberCls }}</td>
                  <td>{{ item.nameGrade }}</td>
                  <td>{{ item.nameOption }}</td>
                  <td v-if="!item.nameBranch">----------</td>
                  <td v-else>{{ item.nameBranch }}</td>
                  <td>
                    <span>
                      <!-- <a
                        href="javascript:void()"
                        class="mr-4"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Edit"
                      >
                        <span class="badge badge-info">
                          <i class="fas fa-trash-restore"></i>
                          <span>&ensp;Modifier</span>
                        </span>
                      </a>-->
                      <a
                        href="javascript:void()"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Close"
                        @click="DeleteClasse(item.id)"
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
</template>
<script>
export default {
  data() {
    return {
      Classes: [],
      Cycles: [],
      IdCycle: ""
    };
  },
  methods: {
    GetClass() {
      axios.get("/getclasses/" + this.IdCycle).then(response => {
        if (response.data["status"] == "success") {
          this.Classes = response.data["classes"];
          console.log(this.Classes);
        }
      });
    },

    GetClasseLoaded() {
      axios.get("/getclasses/" + 1).then(response => {
        if (response.data["status"] == "success") {
          this.Classes = response.data["classes"];
          console.log(this.Classes);
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
    DeleteClasse(idClasse) {
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
          axios.post("classe/delete/" + idClasse).then(response => {
            if (response.data["status"] == "success") {
              // alert(this.IdCycle);
              this.Classes = [];
              this.GetClass();
            }
          });
          Swal.fire("Supprimé!", "L'enseignant a été supprimé.", "success");
        }
      });
    }
  },
  created() {
    this.GetClasseLoaded();
    this.GetCycles();
  }
};
</script>
