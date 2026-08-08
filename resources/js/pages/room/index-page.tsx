import { RoomCardList } from '@/components/custom/pagination/content/card-room-pages';
import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    Room,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-sidebar-layout-wrapper';

export default function ({ page }: { page: Paginator<Room> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Room Page',
            href: route('room.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='p-4'>
                <div className='pb-3'>
                    <CustomPagination paginator={page} urlDestination='room.page'/>
                </div>
                <RoomCardList paginator={page} />
            </div>
        </AppLayout>
    );
}
