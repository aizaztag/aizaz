import React from 'react'
import HomePage from './context/HomePage'
import { UserProvider } from './context/UserContext'

    function App() {
    const user = { name: 'Tania', loggedIn: true }

    return (
        <UserProvider value={user}>
            <HomePage />
        </UserProvider>
    )
}

export default App;
