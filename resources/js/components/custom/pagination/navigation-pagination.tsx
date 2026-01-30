import { Input } from "@/components/ui/input";
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationItem,
    PaginationLink,
    PaginationNext,
    PaginationPrevious,
} from "@/components/ui/pagination";
import {
    PaginationComponentProps,
    PaginationLinkType,
} from "@/types/index";
import {
    Link,
    router
} from "@inertiajs/react";
import React, { useMemo } from "react";

function CustomPaginationNavigation<T>({ paginator, className, urlDestination = 'room.page' }: PaginationComponentProps<T>) {
    // Gunakan useMemo untuk menghitung link yang akan ditampilkan
    // hanya ketika paginator berubah
    const pagesToRender = useMemo(() => {
        const { current_page, last_page, links } = paginator;
        const pageLinks: (PaginationLinkType | { isEllipsis: true })[] = [];

        // 1. Selalu tampilkan halaman pertama
        pageLinks.push(links[1]); // links[0] adalah 'Previous', links[1] adalah halaman '1'

        // 2. Tampilkan elipsis jika halaman saat ini lebih besar dari 3
        if (current_page > 3) {
            pageLinks.push({ isEllipsis: true });
        }

        // 3. Tampilkan halaman sebelum, saat ini, dan sesudah
        for (let i = current_page - 1; i <= current_page + 1; i++) {
            if (i > 1 && i < last_page) {
                // Temukan link yang sesuai di data asli
                const link = links.find(l => !isNaN(Number(l.label)) && Number(l.label) === i);
                if (link) {
                    pageLinks.push(link);
                }
            }
        }

        // 4. Tampilkan elipsis jika halaman saat ini kurang dari (halaman terakhir - 2)
        if (current_page < last_page - 2) {
            pageLinks.push({ isEllipsis: true });
        }

        // 5. Selalu tampilkan halaman terakhir jika lebih dari 1 halaman
        if (last_page > 1) {
            pageLinks.push(links[links.length - 2]); // links[links.length - 1] adalah 'Next'
        }

        // Menghapus duplikat, terutama untuk kasus halaman sedikit
        const uniqueLabels = new Set();
        return pageLinks.filter(link => {
            if ('isEllipsis' in link || !uniqueLabels.has(link.label)) {
                if ('label' in link) uniqueLabels.add(link.label);
                return true;
            }
            return false;
        });

    }, [paginator]);

    return (
        <div className={className}>
            <Pagination className="@container/main">
                <PaginationContent className="w-full justify-center xl:justify-between gap-4 px-4 lg:px-6">
                    <div className="hidden xl:block">
                        <div className="text-muted-foreground text-sm">
                            {/* <div>Showing sequence items from <b>{paginator.from}</b> to <b>{paginator.to}</b>. Items per Pages: <b>{paginator.per_page}</b>.</div> */}
                            <div className="flex flex-row gap-1">
                                <div>Showing sequence items from <b>{paginator.from}</b> to <b>{paginator.to}</b>.</div>
                                {/* <div>Items per Pages: <b>{paginator.per_page}</b>.</div> */}
                            </div>
                            <div className="flex flex-row gap-1">
                                <div className="">Items per Pages:</div>
                                <form
                                    onSubmit={(event) => {
                                        event.preventDefault();
                                        console.info("Seletah Prevent Default di navigation-pagination dipanggil.");

                                        const form: HTMLFormElement = event.currentTarget;
                                        const input = form.querySelector<HTMLInputElement>("input[name='per_page']");

                                        const inputNull = input === null;
                                        if (inputNull) {
                                            return
                                        };

                                        const perPageValueFromStringToNumberDataType = Number(input.value);

                                        // Validasi apakah per_page bukan angka.
                                        const perpageIsNotaNumber = Number.isNaN(perPageValueFromStringToNumberDataType);
                                        if (perpageIsNotaNumber) {
                                            return
                                        };

                                        // Validasi apakah per_page tipe-nya bukan angka.
                                        const numberIsNotInteger = !Number.isInteger(perPageValueFromStringToNumberDataType);
                                        if (numberIsNotInteger) {
                                            input.value = String(paginator.current_page);
                                            return
                                        };

                                        router.get(
                                            route(urlDestination, { per_page: perPageValueFromStringToNumberDataType }),
                                            {},
                                            { preserveScroll: true }
                                        );
                                    }}>
                                    <Input
                                        defaultValue={paginator.per_page}
                                        name="per_page"
                                        className="w-12 px-2 h-5 text-center border rounded-md"
                                    />
                                </form>
                            </div>
                            <div className="flex flex-row gap-1">
                                <div>Total Items: <b className="font-extrabold">{paginator.total}</b>.</div>
                                <div>Current Pages: <b className="font-extrabold">{paginator.current_page}</b>.</div>
                                <div>Total Pages: <b>{paginator.last_page}</b></div>
                            </div>
                        </div>
                    </div>
                    <div className="flex flex-row items-center gap-1">
                        {/* Tombol "Previous" */}
                        <PaginationItem>
                            <PaginationPrevious
                                as={paginator.prev_page_url ? Link : "span"}
                                href={paginator.prev_page_url ?? undefined}
                                className={!paginator.prev_page_url ? "cursor-not-allowed text-muted-foreground" : ""} />
                        </PaginationItem>
                        {/* Tombol Halaman yang sudah di-generate */}
                        {pagesToRender.map((link, index) => (
                            <React.Fragment key={index}>
                                {"isEllipsis" in link ? (
                                    <PaginationItem>
                                        <PaginationEllipsis />
                                    </PaginationItem>
                                ) : (
                                    <PaginationItem>
                                        {
                                            link.active ? (
                                                <form
                                                    onSubmit={(event) => {
                                                        event.preventDefault();
                                                        console.info("Seletah Prevent Default di navigation-pagination dipanggil.");

                                                        const form: HTMLFormElement = event.currentTarget;
                                                        const input = form.querySelector<HTMLInputElement>("input[name='page']");
                                                        const lastPage = paginator.last_page;

                                                        const inputNull = input === null;
                                                        if (inputNull) {
                                                            return
                                                        };

                                                        const pageIntValue = Number(input.value);

                                                        // Validasi bukang angka
                                                        if (Number.isNaN(pageIntValue)) {
                                                            return
                                                        };

                                                        // Validasi tipe angka
                                                        const numberIsNotInteger = !Number.isInteger(pageIntValue);
                                                        if (numberIsNotInteger) {
                                                            input.value = String(paginator.current_page);
                                                            return
                                                        };

                                                        // Validasi batas nilai
                                                        const pageValueOutOfRange = pageIntValue < 1 || pageIntValue > lastPage;
                                                        if (pageValueOutOfRange) {
                                                            input.value = String(paginator.current_page);
                                                            return
                                                        };

                                                        router.get(
                                                            route(urlDestination, { page: pageIntValue }),
                                                            {},
                                                            { preserveScroll: true }
                                                        );
                                                    }}>
                                                    <Input
                                                        defaultValue={link.label}
                                                        name="page"
                                                        className="w-10 text-center border rounded-md"
                                                    />
                                                </form>
                                            ) : (
                                                <PaginationLink
                                                    as={Link}
                                                    href={link.url!}
                                                    isActive={link.active}>
                                                    {link.label}
                                                </PaginationLink>
                                            )
                                        }
                                    </PaginationItem>
                                )}
                            </React.Fragment>
                        ))}
                        {/* Tombol "Next" */}
                        <PaginationItem>
                            <PaginationNext
                                as={paginator.next_page_url ? Link : "span"}
                                href={paginator.next_page_url ?? undefined}
                                className={!paginator.next_page_url ? "cursor-not-allowed text-muted-foreground" : ""} />
                        </PaginationItem>
                    </div>
                </PaginationContent>
            </Pagination>
        </div>
    );
}

export {
    CustomPaginationNavigation
}