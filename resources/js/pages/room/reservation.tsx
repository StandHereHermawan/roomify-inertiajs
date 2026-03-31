import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-sidebar-layout-wrapper';
import RoomReservationTable from '@/components/custom/pagination/content/table-room-reservation-pages';

export default function ({ page }: { page: Paginator<unknown> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Room Reservation Page',
            href: route('room.reservation.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPagination paginator={page} urlDestination='room.reservation.page' />
                </div>
                <RoomReservationTable paginator={page} />
            </div>
        </AppLayout>
    );
}
