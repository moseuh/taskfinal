<template>
  <div class="login-container">
    <div class="login-card">
      <h1>Login</h1>
      <form @submit.prevent="login" class="login-form">
        <input v-model="email" type="email" placeholder="Email" required class="rounded-input" />
        <input v-model="password" type="password" placeholder="Password" required class="rounded-input" />
        <button type="submit" class="rounded-button">Login</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from '../axios';

export default {
  data() {
    return {
      email: '',
      password: ''
    };
  },
  methods: {
    async login() {
      try {
        console.log('Email:', this.email);
        console.log('Password:', this.password);

        const response = await axios.post('/login', {
          email: this.email,
          password: this.password
        });

        console.log('Response:', response);
        localStorage.setItem('token', response.data.token);
        this.$router.push('/tasks');
      } catch (error) {
        console.error('Network Error:', error);
      }
    }
  }
};
</script>



<style>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.login-card {
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
}

.login-form {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.rounded-input {
  border-radius: 20px;
  padding: 10px;
  margin: 5px;
  border: 1px solid #ccc;
}

.rounded-button {
  border-radius: 20px;
  padding: 10px 20px;
  margin: 5px;
  border: none;
  background-color: purple;
  color: white;
  cursor: pointer;
}

.rounded-button:hover {
  background-color: darkpurple;
}
</style>
