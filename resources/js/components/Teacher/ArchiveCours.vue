<template>
  <div>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <span style="font-size:19px;" class="titleheader">
            <i class="fas fa-book"></i> Archives
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
            <h4 class="card-title">Les archives cours</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table
                class="table table-bordered verticle-middle table-responsive-sm"
                style="color:black"
              >
                <thead>
                  <tr>
                    <th scope="col">Nom cours</th>
                    <th scope="col">Description</th>
                    <th scope="col">Session cour</th>
                    <th scope="col">Niveau</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(item,index) in AllCourses" :key="index">
                    <td>{{ item.nameCourse }}</td>
                    <td>{{ item.descriptionCourse }}</td>
                    <td>{{ item.sessionCourse }}</td>
                    <td>{{ item.nameGrade }}</td>
                    <td>
                      <span>
                        <a
                          href="javascript:void()"
                          class="mr-4"
                          data-toggle="tooltip"
                          data-placement="top"
                          title="Edit"
                          @click="RestoreCourse(item.id)"
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
                          @click="DeleteCourse(item.id)"
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
      AllCourses: []
    };
  },
  methods: {
    RestoreCourse(idcourse) {
      axios.post("course/" + idcourse + "/restore").then(response => {
        if (response.data["status"] == "success") {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500
          });
          this.ShowCourses();
        }
      });
    },
    ShowCourses() {
      (this.AllCourses = []),
        axios.get("course/archive").then(response => {
          if (response.data["status"] == "success") {
            this.AllCourses = response.data["courses"];
            //   console.log(this.GradesName);
          }
        });
    },
    DeleteCourse(idcour) {
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
          axios.post("course/" + idcour + "/destroy").then(response => {
            if (response.data["status"] == "success") {
              // this.Alladmins = [];
              this.ShowCourses();
            }
          });
          Swal.fire("Supprimé!", "le cour a été supprimé.", "success");
        }
      });
    }
  },
  created() {
    this.ShowCourses();
  }
};
</script>