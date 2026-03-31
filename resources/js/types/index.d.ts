import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface UserSession {
    id: string;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface Room {
    id: number;
    thumbnail: string;
    room_code: string;
    name: string;
    description: string;
    height_in_meter: number;
    floor_wide_in_meter_squared: number;
    created_at: string; // Tipe string lebih aman untuk tanggal dari JSON...
    updated_at: string;
}

export interface RoomSession {
    id: number;
    room_session_start: string;
    room_session_end: string;
    created_at: string; // Tipe string lebih aman untuk tanggal dari JSON...
    updated_at: string;
}

export interface Role {
    id: number;
    role: string;
    created_at: string; // Tipe string lebih aman untuk tanggal dari JSON...
    deleted_at: string; // Tipe string lebih aman untuk tanggal dari JSON...
    updated_at: string;
}

// Interface untuk objek link paginasi
export interface PaginationLinkType {
    url: string | null;
    label: string;
    page: string;
    active: boolean;
}

// Interface utama untuk objek paginator dari Laravel
export interface Paginator<T> {
    current_page: number;
    data: T[]; // T adalah tipe generik untuk item data, seperti Room
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

export interface PaginationComponentProps<T> {
    paginator: Paginator<T>;
    className?: string;
    urlDestination?: string;
}