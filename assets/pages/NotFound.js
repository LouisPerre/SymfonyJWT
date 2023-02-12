import React from 'react'
import Layout from "../components/Layout"
import Header from '../components/Header'

function NotFound() {

    return (
        <Layout>
            <Header/>
            <div className="container">
                <h2 className="text-center mt-5 mb-3">404 | Page Not Found</h2>
            </div>
        </Layout>
    );
}

export default NotFound;