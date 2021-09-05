<template>
  <div id="right">
    <h1>Development CRM</h1>

    <div class="horizontal">
      <img :src="'/images/horizontal.png'" alt="horizontal"/>
    </div>

    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem sapiente quaerat nulla nesciunt obcaecati adipisci. Tempora, sit reiciendis? Eum natus alias beatae quaerat minima saepe, minus unde! Temporibus, in eum?
    </p>

    <div class="tasks">
      <div class="add-tasks">
        <h2>Today tasks</h2>

        <div class="add-action">
          <img :src="'/images/add.png'" alt="">
        </div>
      </div>

      <ul class="tasks-list">
        <li v-for="todayTask in todayTasks" v-bind:key="todayTask.id">
          <div class="info">

            <div class="left">
              <label class="myCheckBox">
                <input 
                  type="checkbox" 
                  name="test" 
                  :checked="todayTask.completed" 
                  @change="updateTodayTask(todayTask.taskID)"
                />
                <span></span>
              </label>
              <h4>{{todayTask.title}}</h4>
            </div>

            <div class="right">
              <img :src="'/images/edit.png'" alt="">
              <img :src="'/images/del.png'" alt="" @click="delTodayTask(todayTask.taskID)">
              <button
                v-bind:class="{
                  inprogress: !todayTask.approved,
                  approved: todayTask.approved,
                }"
              >
                {{ todayTask.approved ? "Approved" : "In progress" }}
              </button>
            </div>

          </div>
        </li>
      </ul>
    </div>

    <div class="upcoming">
      <div class="add-tasks">
        <h2>Upcoming</h2>
        <div class="add-action">
          <img :src="'/images/add.png'" alt="">
        </div>
      </div>

        <form action="" @submit="addUpcomingTask">
          <input type="text" v-model="newTask">
        </form>

        <ul class="tasks-list">
          <li v-for="upcomingTask in upcoming" v-bind:key="upcomingTask.id">
            <div class="info">

              <div class="left">
                <label class="myCheckBox">
                  <input 
                    type="checkbox" 
                    name="test" 
                    :checked="upcomingTask.completed" 
                    @change="checkUpcoming(upcomingTask.taskID)"
                  />
                  <span></span>
                </label>
                <h4>{{upcomingTask.title}}</h4>
              </div>

              <div class="right">
                <img :src="'/images/edit.png'" alt="">
                <img :src="'/images/del.png'" alt="" @click="delUpcoming(upcomingTask.taskID)">
                <button
                v-bind:class="{
                  inprogress: !upcomingTask.approved,
                  approved: upcomingTask.approved,
                }"
              >
                {{ upcomingTask.approved ? "Approved" : "In progress" }}
              </button>
              </div>

            </div>
          </li>
        </ul>

      <!-- </div> -->
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      todayTasks: [],
      upcoming: [],
      newTask: ""
    };
  },
  created() {
    this.fetchTodayTasks();
    this.fetchUpcoming();
  },
  methods: {
    fetchUpcoming(){
      fetch('http://laravel-customer-retail-management.test/api/upcoming')
        .then(res => res.json())
        .then(({data}) => {
          this.upcoming = data;
        })
        .catch((err) => console.log(err));
    },
    addUpcomingTask(e){
      e.preventDefault();
      if(this.upcoming.length > 4){
        alert("Please, complete today tasks");
      } else {
        const newTask = {
          title: this.newTask,
          waiting: true,
          taskID: Math.random().toString(36).substring(7)
        };
        // Send POST Request
        fetch('http://laravel-customer-retail-management.test/api/upcoming', {
          method: "POST",
          headers: {
            "content-type": "application/json"
          },
          body: JSON.stringify(newTask),
        }).then(() => this.upcoming.push(newTask));
        this.newTask = "";
      }
    },
    delUpcoming(taskID){
      if(confirm("Are you sure want to delete?")){
        fetch('/api/upcoming/'+taskID, {
          method: "DELETE",
        })
          .then((res) => res.json())
          .then(() => {
            this.upcoming = this.upcoming.filter(
              ({taskID: id})=> id !== taskID
            );
            console.log("Delete");
        }).catch((err) => console.log(err));
      }
    },
    fetchTodayTasks(){
      fetch('/api/today-task')
        .then(res => res.json())
        .then(({data}) => {this.todayTasks = data})
        .catch(err => console.log(err))
    },
    checkUpcoming(taskID){
      if(this.todayTasks.length > 4){
        alert("Please, complete today tasks");
        window.location.href = '/';
      } else {
        this.addDailyTask(taskID);
        // this.add
        fetch(`/api/upcoming/${taskID}`, {
          method: "DELETE"
        }).then(() => (this.upcoming = this.upcoming.filter(({taskID: id}) => id !== taskID)));
      }
    },
    addDailyTask(taskID){
      // Get Task
      const task = this.upcoming.filter(({taskID: id}) => id === taskID)[0];
      console.log(task);
      // POST Request
      fetch('/api/today-task', {
        method: "POST",
        headers: {
          "content-type": "application/json"
        },
        body: JSON.stringify(task),
      }).then(() => this.todayTasks.unshift(task)).catch(err => console.log(err));
    },
    delTodayTask(taskID){
      if(confirm("Are you sure want to delete?")){
        fetch(`/api/today-task/${taskID}`, {
          method: "DELETE",
        })
          .then((res) => res.json())
          .then(() => (this.todayTasks = this.todayTasks.filter(({taskID: id}) => id !== taskID)))
          .catch(err => console.log(err))
      }
    },
    updateTodayTask(taskID){
      if(confirm("Are you sure?")){
        fetch('/api/today-task/'+taskID, {
          method: "DELETE"
        })
          .then(() => {})
          .then(() => {this.todayTasks = this.todayTasks.filter(({taskID: id}) => id !== taskID)})
          .catch(err => console.log(err))
      }
    }
  },
}
</script>

<style>

</style>