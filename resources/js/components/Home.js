export default {
  render() {
    axios.get('/api/user')
    .then(res => {
      localStorage.setItem('user', true);
      this.$router.push('game')
    })
    .catch(err => {
      localStorage.removeItem('user');
      this.$router.push('login')
    })
  }
}
