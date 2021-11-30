<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Classes</h4>
          <div class="float-right col-lg-4">
            <!-- <label class="text-dark">Cycle</label> -->
            <select class="form-control form-control" @change="GetClass(IdCycle)" v-model="IdCycle">
              <option
                v-for="(item,index) in Cycles"
                :key="index"
                :value="item.id"
                selected
              >{{ item.name }}</option>
            </select>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table
              class="table table-bordered verticle-middle table-responsive-sm"
              style="color:black"
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
                  <td>{{ item.nameBranch }}</td>
                  <td>
                    <span>
                      <a
                        href="javascript:void()"
                        class="mr-4"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Edit"
                      >
                        <i class="fa fa-pencil color-muted"></i>
                      </a>
                      <a
                        href="javascript:void()"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Close"
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
    }
  },
  created() {
    this.GetClasseLoaded();
    this.GetCycles();
  }
};
</script>
