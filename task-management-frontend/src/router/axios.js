


// src/axios.js
import axios from 'axios';

const instance = axios.create({
  baseURL: 'http://localhost:8000/', // Ensure this URL is correct
  headers: {
    'Content-Type': 'application/json',
    c
  },
});

export default instance;
