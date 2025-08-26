import { CardList } from '@/components/custom/pagination/card-pages';
import {
    CustomPaginationNavigation as CustomPagination
} from '@/components/custom/pagination/navigation-pagination';
import {
    Paginator,
    Room,
    type BreadcrumbItem
} from '@/types';
import { Head } from '@inertiajs/react';
import AppLayout from '@/layouts/custom/app-layout';

export default function ({ page }: { page: Paginator<Room> }) {

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Room Session Page',
            href: route('room.session.page'),
        },
    ];

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={breadcrumbs[0].title} />
            <div className='py-4'>
                <CustomPagination paginator={page} />
                <CardList paginator={page} />
            </div>
        </AppLayout>
    );
}
