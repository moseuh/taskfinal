<template>
  <div class="task-container">
    <h1>Tasks</h1>
    <button @click="logout" class="rounded-button">Logout</button>
    <div v-if="user.role === 'admin'" class="admin-task-form">
      <h2>Assign Task</h2>
      <form @submit.prevent="createTask" class="task-form">
        <input v-model="title" placeholder="Title" class="rounded-input" required />
        <textarea v-model="description" placeholder="Description" class="rounded-input"></textarea>
        <input v-model="deadline" type="date" class="rounded-input" required />
        <input v-model="userId" type="number" placeholder="User ID" class="rounded-input" required />
        <button type="submit" class="rounded-button">Assign Task</button>
      </form>
    </div>
    <div v-for="task in tasks" :key="task.id" class="task-box">
      <h3>{{ task.title }}</h3>
      <p>{{ task.description }}</p>
      <p>Deadline: {{ task.deadline }}</p>
      <p>Status: {{ task.status }}</p>
    </div>
  </div>
</template>

<script>
import axios from '../axios';

export default {
  data() {
    return {
      tasks: [],
      title: '',
      description: '',
      deadline: '',
      userId: '',
      user: {}
    };
  },
  async created() {
    try {
      const response = await axios.get('/tasks');
      this.tasks = response.data;

      const userInfo = await axios.get('/user');
      this.user = userInfo.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async createTask() {
      try {
        await axios.post('/tasks', {
          title: this.title,
          description: this.description,
          deadline: this.deadline,
          user_id: this.userId
        });

        // Fetch tasks again to refresh the list
        const response = await axios.get('/tasks');
        this.tasks = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async logout() {
      try {
        await axios.post('/logout');

        localStorage.removeItem('token');
        this.$router.push('/login');
      } catch (error) {
        console.error(error);
      }
    }
  }
};
</script>

<style>
.task-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
}

.admin-task-form {
  width: 100%;
  max-width: 600px;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 20px;
}

.task-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.rounded-input {
  border-radius: 20px;
  padding: 10px;
  margin: 5px;
  border: 1px solid #ccc;
  width: 100%;
}

.rounded-button {
  border-radius: 20px;
  padding: 10px 20px;
  margin: 5px;
  border: none;
  background-color: purple;
  color: white;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.rounded-button:hover {
  background-color: darkpurple;
}

.task-box {
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin: 10px 0;
  width: 100%;
  max-width: 600px;
}
</style>
