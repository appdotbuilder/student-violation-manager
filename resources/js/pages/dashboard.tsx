import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface Props {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
            role: 'administrator' | 'teacher';
        };
    };
    stats: {
        total_students: number;
        total_violations: number;
        total_categories: number;
        total_types: number;
        total_users?: number;
    };
    recentViolations: Array<{
        id: number;
        violation_date: string;
        points: number;
        student: {
            name: string;
            class: string;
        };
        violation_category: {
            name: string;
        };
        violation_type: {
            name: string;
        };
        recorded_by: {
            name: string;
        };
    }>;
    topCategories: Array<{
        id: number;
        name: string;
        violations_count: number;
    }>;
    topStudents: Array<{
        id: number;
        name: string;
        class: string;
        violations_count: number;
        total_points: number;
    }>;
    monthlyViolations: Array<{
        month: string;
        count: number;
    }>;
    [key: string]: unknown;
}

export default function Dashboard({ auth, stats, recentViolations, topCategories, topStudents, monthlyViolations }: Props) {
    const user = auth.user;
    const isAdmin = user.role === 'administrator';

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            
            <div className="space-y-6">
                {/* Welcome Section */}
                <div className="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-6 text-white">
                    <h1 className="text-2xl font-bold mb-2">
                        Welcome back, {user.name}! 👋
                    </h1>
                    <p className="text-blue-100">
                        {isAdmin 
                            ? "You have full administrative access to manage the student violations system."
                            : "You can record violations and view student histories."
                        }
                    </p>
                </div>

                {/* Statistics Cards */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Active Students</CardTitle>
                            <span className="text-2xl">👥</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-blue-600">{stats.total_students}</div>
                            <p className="text-xs text-muted-foreground">
                                Total active students
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">
                                {isAdmin ? 'Total Violations' : 'My Violations'}
                            </CardTitle>
                            <span className="text-2xl">⚠️</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-red-600">{stats.total_violations}</div>
                            <p className="text-xs text-muted-foreground">
                                {isAdmin ? 'All recorded violations' : 'Violations you recorded'}
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Categories</CardTitle>
                            <span className="text-2xl">📋</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-purple-600">{stats.total_categories}</div>
                            <p className="text-xs text-muted-foreground">
                                Violation categories
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">
                                {isAdmin && stats.total_users ? 'System Users' : 'Violation Types'}
                            </CardTitle>
                            <span className="text-2xl">{isAdmin && stats.total_users ? '👤' : '📝'}</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-green-600">
                                {isAdmin && stats.total_users ? stats.total_users : stats.total_types}
                            </div>
                            <p className="text-xs text-muted-foreground">
                                {isAdmin && stats.total_users ? 'Teachers & administrators' : 'Available violation types'}
                            </p>
                        </CardContent>
                    </Card>
                </div>

                {/* Quick Actions */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center">
                            🚀 Quick Actions
                        </CardTitle>
                        <CardDescription>
                            Access frequently used features
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <Link href="/violations/create">
                                <Button className="w-full" variant="default">
                                    📝 Record Violation
                                </Button>
                            </Link>
                            <Link href="/students">
                                <Button className="w-full" variant="outline">
                                    👥 View Students
                                </Button>
                            </Link>
                            <Link href="/violations">
                                <Button className="w-full" variant="outline">
                                    📋 View Violations
                                </Button>
                            </Link>
                            {isAdmin && (
                                <Link href="/violation-categories">
                                    <Button className="w-full" variant="outline">
                                        ⚙️ Manage Categories
                                    </Button>
                                </Link>
                            )}
                        </div>
                    </CardContent>
                </Card>

                {/* Content Grid */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Recent Violations */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center">
                                📋 Recent Violations
                            </CardTitle>
                            <CardDescription>
                                {isAdmin ? 'Latest violations in the system' : 'Violations you recently recorded'}
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {recentViolations.length > 0 ? (
                                    recentViolations.slice(0, 5).map((violation) => (
                                        <div key={violation.id} className="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div className="flex-1">
                                                <div className="font-medium text-sm">
                                                    {violation.student.name} ({violation.student.class})
                                                </div>
                                                <div className="text-xs text-gray-600">
                                                    {violation.violation_type.name} • {violation.points} points
                                                </div>
                                                <div className="text-xs text-gray-500">
                                                    {new Date(violation.violation_date).toLocaleDateString()} 
                                                    {isAdmin && ` • by ${violation.recorded_by.name}`}
                                                </div>
                                            </div>
                                            <div className="text-right">
                                                <span className="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    -{violation.points}
                                                </span>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <div className="text-center py-8 text-gray-500">
                                        <span className="text-4xl mb-2 block">📝</span>
                                        No violations recorded yet
                                    </div>
                                )}
                            </div>
                            {recentViolations.length > 0 && (
                                <div className="mt-4 text-center">
                                    <Link href="/violations">
                                        <Button variant="outline" size="sm">
                                            View All Violations
                                        </Button>
                                    </Link>
                                </div>
                            )}
                        </CardContent>
                    </Card>

                    {/* Top Violation Categories This Month */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center">
                                📊 Top Categories This Month
                            </CardTitle>
                            <CardDescription>
                                Most frequent violation categories
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-4">
                                {topCategories.length > 0 ? (
                                    topCategories.map((category, index) => (
                                        <div key={category.id} className="flex items-center justify-between">
                                            <div className="flex items-center space-x-3">
                                                <div className="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-sm font-medium text-blue-600">
                                                    {index + 1}
                                                </div>
                                                <span className="font-medium">{category.name}</span>
                                            </div>
                                            <span className="text-sm font-medium bg-gray-100 px-2 py-1 rounded">
                                                {category.violations_count} violations
                                            </span>
                                        </div>
                                    ))
                                ) : (
                                    <div className="text-center py-8 text-gray-500">
                                        <span className="text-4xl mb-2 block">📊</span>
                                        No violations this month
                                    </div>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    {/* Students with Most Violations This Month */}
                    <Card className="lg:col-span-2">
                        <CardHeader>
                            <CardTitle className="flex items-center">
                                🎯 Students Requiring Attention This Month
                            </CardTitle>
                            <CardDescription>
                                Students with the most violations this month
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            {topStudents.length > 0 ? (
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {topStudents.slice(0, 6).map((student) => (
                                        <div key={student.id} className="p-4 border rounded-lg">
                                            <div className="flex justify-between items-start mb-2">
                                                <div>
                                                    <div className="font-medium">{student.name}</div>
                                                    <div className="text-sm text-gray-600">{student.class}</div>
                                                </div>
                                                <div className="text-right">
                                                    <div className="text-sm font-medium text-red-600">
                                                        {student.violations_count} violations
                                                    </div>
                                                    <div className="text-xs text-gray-500">
                                                        {student.total_points} total points
                                                    </div>
                                                </div>
                                            </div>
                                            <Link href={`/students/${student.id}`}>
                                                <Button variant="outline" size="sm" className="w-full">
                                                    View Details
                                                </Button>
                                            </Link>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <span className="text-4xl mb-2 block">🎯</span>
                                    No violations this month
                                </div>
                            )}
                        </CardContent>
                    </Card>
                </div>

                {/* Monthly Trend */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center">
                            📈 Violation Trends (Last 6 Months)
                        </CardTitle>
                        <CardDescription>
                            Monthly violation count overview
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="flex items-end space-x-2 h-32">
                            {monthlyViolations.map((month, index) => (
                                <div key={index} className="flex-1 flex flex-col items-center">
                                    <div 
                                        className="w-full bg-blue-500 rounded-t-sm transition-all hover:bg-blue-600"
                                        style={{ 
                                            height: `${Math.max((month.count / Math.max(...monthlyViolations.map(m => m.count))) * 100, 5)}%` 
                                        }}
                                        title={`${month.month}: ${month.count} violations`}
                                    ></div>
                                    <div className="text-xs mt-1 text-center">
                                        {month.month.split(' ')[0]}
                                    </div>
                                    <div className="text-xs font-medium text-blue-600">
                                        {month.count}
                                    </div>
                                </div>
                            ))}
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    );
}