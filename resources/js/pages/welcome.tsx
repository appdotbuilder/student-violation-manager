import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface Props {
    auth?: {
        user: {
            id: number;
            name: string;
            email: string;
            role: string;
        };
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    return (
        <>
            <Head title="Student Violations Management System" />

            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">
                {/* Header */}
                <header className="bg-white/80 backdrop-blur-sm border-b border-gray-200 sticky top-0 z-50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center py-4">
                            <div className="flex items-center space-x-3">
                                <div className="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-lg">📋</span>
                                </div>
                                <div>
                                    <h1 className="text-xl font-bold text-gray-900">SVMS</h1>
                                    <p className="text-xs text-gray-600">Student Violations Management</p>
                                </div>
                            </div>
                            
                            {auth?.user ? (
                                <div className="flex items-center space-x-4">
                                    <Link
                                        href="/dashboard"
                                        className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        Dashboard
                                    </Link>
                                </div>
                            ) : (
                                <div className="flex items-center space-x-4">
                                    <Link
                                        href="/login"
                                        className="px-4 py-2 text-gray-700 hover:text-blue-600 transition-colors"
                                    >
                                        Login
                                    </Link>
                                    <Link
                                        href="/register"
                                        className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        Register
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <section className="py-20 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto text-center">
                        <div className="mb-8">
                            <h1 className="text-4xl md:text-6xl font-bold text-gray-900 mb-6">
                                📚 Student Violations
                                <span className="block text-blue-600">Management System</span>
                            </h1>
                            <p className="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                                Comprehensive digital solution for tracking, managing, and reporting student violations. 
                                Streamline your school's disciplinary processes with powerful analytics and role-based access.
                            </p>
                        </div>

                        {!auth?.user && (
                            <div className="flex justify-center space-x-4 mb-16">
                                <Link href="/login">
                                    <Button size="lg" className="px-8 py-3 text-lg">
                                        🔐 Login to System
                                    </Button>
                                </Link>
                                <Link href="/register">
                                    <Button variant="outline" size="lg" className="px-8 py-3 text-lg">
                                        📝 Register Account
                                    </Button>
                                </Link>
                            </div>
                        )}
                    </div>
                </section>

                {/* Features Grid */}
                <section className="py-16 px-4 sm:px-6 lg:px-8 bg-white/50">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-16">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">
                                🎯 Key Features
                            </h2>
                            <p className="text-lg text-gray-600 max-w-2xl mx-auto">
                                Everything you need to manage student violations efficiently and effectively
                            </p>
                        </div>

                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            {/* For Teachers */}
                            <Card className="border-2 border-green-200 bg-green-50/50">
                                <CardHeader>
                                    <CardTitle className="flex items-center text-green-800">
                                        👩‍🏫 For Teachers
                                    </CardTitle>
                                    <CardDescription>Record and track violations easily</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-3">
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                        Record student violations instantly
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                        View violation history by student
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                        Track your recorded violations
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-green-500 rounded-full mr-3"></span>
                                        Auto-calculated violation points
                                    </div>
                                </CardContent>
                            </Card>

                            {/* For Administrators */}
                            <Card className="border-2 border-blue-200 bg-blue-50/50">
                                <CardHeader>
                                    <CardTitle className="flex items-center text-blue-800">
                                        👨‍💼 For Administrators
                                    </CardTitle>
                                    <CardDescription>Complete system management</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-3">
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                        Manage all student data
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                        Configure violation categories & types
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                        Manage teacher accounts
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-blue-500 rounded-full mr-3"></span>
                                        Generate comprehensive reports
                                    </div>
                                </CardContent>
                            </Card>

                            {/* Violation Categories */}
                            <Card className="border-2 border-purple-200 bg-purple-50/50">
                                <CardHeader>
                                    <CardTitle className="flex items-center text-purple-800">
                                        📋 Violation Categories
                                    </CardTitle>
                                    <CardDescription>Organized violation management</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-3">
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                        Disiplin (Attendance & Punctuality)
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                        Seragam (Uniform Compliance)
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                        Akademik (Academic Conduct)
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-purple-500 rounded-full mr-3"></span>
                                        Ketertiban & Sopan Santun
                                    </div>
                                </CardContent>
                            </Card>

                            {/* Reporting & Analytics */}
                            <Card className="border-2 border-orange-200 bg-orange-50/50">
                                <CardHeader>
                                    <CardTitle className="flex items-center text-orange-800">
                                        📊 Reports & Analytics
                                    </CardTitle>
                                    <CardDescription>Data-driven insights</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-3">
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                        Student violation history
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                        Filter by date, class, category
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                        Violation trends & statistics
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-orange-500 rounded-full mr-3"></span>
                                        Points accumulation tracking
                                    </div>
                                </CardContent>
                            </Card>

                            {/* Search & Filter */}
                            <Card className="border-2 border-teal-200 bg-teal-50/50">
                                <CardHeader>
                                    <CardTitle className="flex items-center text-teal-800">
                                        🔍 Search & Filter
                                    </CardTitle>
                                    <CardDescription>Find information quickly</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-3">
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>
                                        Search students by name/class
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>
                                        Filter by violation category
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>
                                        Date range filtering
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-teal-500 rounded-full mr-3"></span>
                                        Advanced search options
                                    </div>
                                </CardContent>
                            </Card>

                            {/* Data Management */}
                            <Card className="border-2 border-red-200 bg-red-50/50">
                                <CardHeader>
                                    <CardTitle className="flex items-center text-red-800">
                                        🗂️ Data Management
                                    </CardTitle>
                                    <CardDescription>Comprehensive data control</CardDescription>
                                </CardHeader>
                                <CardContent className="space-y-3">
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-red-500 rounded-full mr-3"></span>
                                        Student database management
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-red-500 rounded-full mr-3"></span>
                                        Violation types & point system
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-red-500 rounded-full mr-3"></span>
                                        User role management
                                    </div>
                                    <div className="flex items-center text-sm text-gray-700">
                                        <span className="w-2 h-2 bg-red-500 rounded-full mr-3"></span>
                                        Automated point calculations
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                </section>

                {/* Sample Dashboard Preview */}
                <section className="py-16 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">
                                📈 Dashboard Preview
                            </h2>
                            <p className="text-lg text-gray-600">
                                Get insights at a glance with our comprehensive dashboard
                            </p>
                        </div>

                        <div className="bg-white rounded-xl shadow-lg p-8 border border-gray-200">
                            <div className="grid md:grid-cols-4 gap-6 mb-8">
                                <div className="bg-blue-50 p-6 rounded-lg text-center">
                                    <div className="text-3xl font-bold text-blue-600">250+</div>
                                    <div className="text-sm text-gray-600">Active Students</div>
                                </div>
                                <div className="bg-green-50 p-6 rounded-lg text-center">
                                    <div className="text-3xl font-bold text-green-600">45</div>
                                    <div className="text-sm text-gray-600">Violations This Month</div>
                                </div>
                                <div className="bg-purple-50 p-6 rounded-lg text-center">
                                    <div className="text-3xl font-bold text-purple-600">5</div>
                                    <div className="text-sm text-gray-600">Violation Categories</div>
                                </div>
                                <div className="bg-orange-50 p-6 rounded-lg text-center">
                                    <div className="text-3xl font-bold text-orange-600">20</div>
                                    <div className="text-sm text-gray-600">Violation Types</div>
                                </div>
                            </div>
                            
                            <div className="text-center text-sm text-gray-500">
                                📊 Real-time statistics • 🔄 Auto-updated data • 📱 Mobile responsive
                            </div>
                        </div>
                    </div>
                </section>

                {/* Call to Action */}
                {!auth?.user && (
                    <section className="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-blue-600 to-indigo-600">
                        <div className="max-w-4xl mx-auto text-center text-white">
                            <h2 className="text-3xl font-bold mb-4">
                                🚀 Ready to Get Started?
                            </h2>
                            <p className="text-xl mb-8 opacity-90">
                                Join hundreds of schools already using our system to manage student violations effectively.
                            </p>
                            <div className="flex justify-center space-x-4">
                                <Link href="/register">
                                    <Button size="lg" variant="secondary" className="px-8 py-3 text-lg">
                                        📝 Create Account
                                    </Button>
                                </Link>
                                <Link href="/login">
                                    <Button size="lg" variant="outline" className="px-8 py-3 text-lg border-white text-white hover:bg-white hover:text-blue-600">
                                        🔐 Login Now
                                    </Button>
                                </Link>
                            </div>
                        </div>
                    </section>
                )}

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto text-center">
                        <div className="flex items-center justify-center space-x-3 mb-4">
                            <div className="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold">📋</span>
                            </div>
                            <span className="text-xl font-bold">Student Violations Management System</span>
                        </div>
                        <p className="text-gray-400 mb-4">
                            Streamline your school's disciplinary processes with our comprehensive management solution
                        </p>
                        <div className="text-sm text-gray-500">
                            Built with Laravel • Inertia.js • React • TypeScript
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}