import Home from './components/Home.js'
import Game from './components/Game.vue'
import Login from './components/Login.vue'
import HighScores from './components/HighScores.vue'
import Rules from './components/Rules.vue'

export default [
    { path: '/', component: Home, name: "Home" },
    { path: '/game', component: Game, name: "Game" },
    { path: '/login', component: Login, name: "Login" },
    { path: '/high-scores', component: HighScores, name: "High Scores" },
    { path: '/rules', component: Rules, name: "Rules" },
]
