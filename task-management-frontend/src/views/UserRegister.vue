<template>
  <div class="register-container">
    <div class="register-card">
      <h1>Register</h1>
      <form @submit.prevent="register" class="register-form">
        <input v-model="name" placeholder="Name" required class="rounded-input" />
        <input v-model="email" type="email" placeholder="Email" required class="rounded-input" />
        <input v-model="password" type="password" placeholder="Password" required class="rounded-input" />
        <input v-model="password_confirmation" type="password" placeholder="Confirm Password" required class="rounded-input" />
        <select v-model="role" required class="rounded-input">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
        <button type="submit" class="rounded-button">Register</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      role: 'user'
    };
  },
  methods: {
    async register() {
      try {
        console.log('Registering user with data:', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          role: this.role
        });

        const response = await axios.post('/register', {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
          role: this.role
        });

        console.log('Registration successful:', response);
        localStorage.setItem('token', response.data.token);
        this.$router.push('/tasks');
      } catch (error) {
        console.error('Registration error:', error);
      }
    }
  }
};
</script>

<style>
.register-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.register-card {
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  padding: 2rem;
  text-align: center;
}

.register-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.rounded-input {
  border-radius: 20px;
  padding: 10px;
  border: 1px solid #ccc;
  width: 100%;
}

.rounded-button {
  border-radius: 20px;
  padding: 10px;
  border: none;
  background-color: purple;
  color: white;
  cursor: pointer;
}

.rounded-button:hover {
  background-color: darkpurple;
}
</style>
