@extends('Admin.layout.app')
@section('title')
    <title>{{ __('all.Prodacts') }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
    <style>
        #datatable_filter {
            padding: 5px !important;
            display: none !important;
        }

        table {
            width: 100%;
        }

        /* table thead,
                                table tbody {
                                    display: table;
                                    width: 100%;
                                } */

        table.loading tbody {
            position: relative;
        }

        table.loading tbody:after {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.1);
            background-image: url(data:image/gif;base64,R0lGODlhgACAAKUAACQmJJSSlMTGxFxeXOTi5ExKTKyurHx6fNTW1DQ2NOzu7Ly6vHRydISGhKSipMzOzFRWVCwuLGRmZOzq7LS2tNze3Dw+PPT29MTCxIyOjCwqLJyenMzKzGRiZOTm5ExOTLSytHx+fNza3Dw6PPTy9Ly+vHR2dIyKjKyqrNTS1FxaXPj4+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQJCQArACwAAAAAgACAAAAG/sCVcEgsGo/IpHLJbDqf0KhUeVEQRIiH6Cj4qA4Z1IM0LZvP08tE9BBgSu936rgA2O+AkSqDuaD/gGYKFQ9xcIdxD3R2Gox4ABoDARyBlZZGJCJuhpyIikZ1j42QjgAWGVuXqmYXBBwliLGdGJ9FdaOPoqQQGxOrv00kCLOyxXOgucm5GhohBMDQRcLE1LHHtqTK2pAaB6nRqyQpxdWztUShd43rpLjKDN/ggBci5PbU50O32+ql2ZANFMj748HNvYOc8glJ164hLnf9ICUAMbCMOIQYDV1D90+ZO3bLAEh4VvHJhHIZZSlcwdBhNpARRSUoUZIJvZQoEy6CyA9m/kdGDfzUPEKiEE6cKxn67IkHogYIJIcOmSDgaE5PO/kx5SkRg9SpV8OqXBRTq8efGih8FXLSasqN+v5xNRvSEaW1bcWGTUq3708AJ9aCdYsS7sKXfrcCaCCYSF7C5Pg2Taw1cEmBSR7rtWeY5V/KyixX9IAhnhHNkBOR9Qc6l+iBeU0XQb1ZY1bWre28Pu3LEomqcWQ7rh15de5ku2djwEAm0AWjb+BUUEI7I60KBCYINXIhBYoTHZgdB0x9OQYO29HUmyV8cFgBFXpLwRCgQOvkwxdg0N8+yoR7/a1QHScCiIDZHyk0kIBf+IG1nH5vyGcRcPZMl1k1AhCQXiAk/mwwglkNsrXfg8uVIEBzZYyDkoVI0IaBhtCQ4MCH2oQooHkQjlhCZ06QhtAbLB6hGQIbAjPBAVzZeBKE+umHiAdpvBJWgG1xcGBFKdiHh5I4jlhiHAIUyUQFmwV5GpFfkcDAKFwy2SUiGJjJBAmEBdjYCihowCWJTX55CBxXMqGiW3LeSQSVJHo5Sxw8HqEAccEZKsVJI+boJDWBJjEopHZKSsSjXXp5UKOfQhpLoZ4qF0eOOpaTqRHDpIYIiqka8SiccCyQEgJLkGAqJ1HVWsSthlj1hphDkCnrG7wKe0Ssv5aAqhBSyoqes0dcUC2kGAiQ2bKAYosEsZDBIeGh/uA2K+6zv74h3AUGmcoBresS8Vu0YZ4WbZz1JkHAshicu8J6qeXbb7bbulWCbAnXFuzBRSjL7V1DXIAvshDDayoctPrIbaf9ElzbG1AOIbLCr0LsHmTxQEcYxSoj0fBR50Q7bcwrSEyYV0LQ+avAOE+1bHP//YoxzhqnVvK/ppIatMsOC3FymUEroXNtzW5qbMlVCynrMVBblXLXPkP2ycxiHR20xanB3PXbcMct99x012333XjnrXe/aKekNtK/3hW2XvTGTW5tn2i9GdBve0zYMVMfdXPQV1vVLNM7r/S24keRVHRqf2fsZ20llw3p2Dgf7haKNtMduV5EDI6T/ttvc/DrOa/jhDrECiwbj+PEgVxv7mFxvQLbphrcddKmbth3TstNXi8B0dJOPEYmhu6str6fBvDDKmNuqsDMQ6a8yuUTd77JAKurMrSptff5r7vXqjpxjK/wfErXHsx99Vbb18Igdr2w3MxX4MKA8cQ1oKMUrgjw+9UDhdXAq3Tqfm4RnqEqiJD6rYBzetGgpDiIDydgcEpVI2ExPCgEEGJEhEOZoIiO4jRp1GldpEGU7qJQOZQESAEi0J4qLoCAQ9xMhaWRQvoOcsQ3WGkoCrAdInRYjvX1CIVJOBya5JEJclDRHvkT1AuVcL8MCTENBKAQe8rDmTP8holsJAYH/ipwRie0Qkrl+KIhToSG+cnih9AzUCCAGC+MNFEWCyzD6/SIkDmy8DQVkCLVLjRF54QNkEdBRAoq4AHUKcADFUhBu6QVx/4BwleGOOS+OgO8BCKKOZf4HCYF2BnxJRAOP0wkIHJIRgEy6git9CUMAxHGE0LGfUOwpS9xmSpjQoqVy1yjoZx5zCMo85aRagyosHkIZAohmNxM4lqoaSpvruCa0TTXV7aZTmZZs52IxAs8f2kED4RTFmHk4gPu6U4jUI+fJRiDoegBT3OiE1xBTFVB0mlOcLZLl3cqSjRrGU6BimuhCYQmNiFaqy6u0pq3FIEMnXWRX7ESXCkY6boUUxBBGgLzVwhQ6cGmUZuTjiymdiMBIfRi09lVQKZvI+RVDPoeQe5tNju9R0/xIYJ8HlUNhChkP4vwTwJpQTtHTYMVsMAB4XjgARxAgAiyU8es7i0IACH5BAkJACwALAAAAACAAIAAhSQmJJSSlMTGxFxeXOTi5ERCRLS2tHx6fDQ2NNTW1JyenOzu7GxqbExOTCwuLMzOzLy+vISGhJyanOzq7ExKTDw+PNze3KSmpPT29HRydCwqLJSWlMzKzGRiZOTm5ERGRLy6vISChDw6PNza3KSipPTy9GxubFRWVDQyNNTS1MTCxIyKjPj4+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAb+QJZwSCwaj8ikcslsOp/QqFSJWRBGicfoOOE8EiPCAjMtm89TzGT0EKgg73fq6IHH4QLthIzu+8sLFg93hHAPXHCJhSoPFgt/kJFGJSNui4qGiJeFAiMlkqBnGAQcEJibmUYTp6wqdw8En6GzTCUJqKhzRh64p29wCbK0w0O2vbl0x4m+wcS0JSmt0ouHqtPXvyopj86QGCPY4YzJ4q13I3zdZx5u5bjVRavKl5gCHupl0O7hukW8+4QCQkghDF+TCfPcwSMiD+A1ARMMMvnm8NjCIf8SzkMnEUmJQRWxXRTSUKO4BwU7spggIKRFTS4fRlRJ0qTGkStjHlNxj+b+Spvl+hHJqFManJk0ERalBhPozgQ+hyh1Kk0oRqrKtkSVirUVzpJLMWnFxw3J1LBWhRDtWmisOl5uVbFV9DVsIQsSp8aNN1cOub6J9hJ5wEFSiZZxBHNdWhfwG8VCHqBAQMAbyGx4k5zVyMgCgT1I1Fy57BIyCw4OAAA4kQ4NuEWmN2MTYAFplAkWStk0jVoDAN8r/IAlFPtYp7JoFozQaFoAAtWqfUNAc/haZrOoBBBo/WcU4mu8UUSHDgBBzzLRel3nskjF9mGjXEnjnfo3ed8ZzKw1B2G9XEUJcPfMLayENx550YGQhm7iFAcBB8ipswCDjykhGYIYAlBASk3+WGCSf/EESBMGBKpA33i+QZfibwFEUUJFpm3FAgEqQJXEhSveh6AGMRaRnkMgykgEh0SgpiOGOebnxAJY9SikEb3Zt6OUK2qQFhI/OuXkk5GJp2KGRwLAQBNMFhUkl0UYKeWUvlUZXY8l6kQkmkJwIF6KOa75JXkHLFFCX5XReYSaYOKpJ4q2GeFhUTYKakQI9uWZJ5jQSaAEhSFxIKCjLJTwAaWRHvplAZotFSGnQ6SgZ5ugZljYEa/F1CiqRhwQZqig+hbCERi0QxUHc9I6gQg5TtqqBiIIKJtNZ9IqxAV7GkupbyoYEatTAmzqrBAlFNDqtwAEl6ZOgW6LhAT+KIK7IwVFYNBVtuYmUYII6oJq236cbUkrpKKC65sBRFzrEASnxkuEqvVmqMGuQ5Bm06sGJ0HBgQn/dgIRXTUbMQsBSOsvCsXolOjGRe5ZMQCBDgeQtiRj4OXJ9ik4Y0xXkjxEBxQnrAEJQgj8oc1JBAAzeQxnCRBPQCMBgqEVazAmCw4DVHDSIwwN3QB1xsSyzSUwrTO7SYct9thkl2322WinrfbabD+JqUlbt4zVq1FrFKzNZTpVjdEmjRw2vu7o4vM+GpO8qFM2EuDSOGbzvU/KOsVtsLtY9fQiVlOTnHdIwmRc9uAaDTZ32RxgtRDo7mRu8AI6uQV4Qvqiivr+POex4G5M8Cbda1fcve2OK4U7S2NMEA8xezgQ5N6y78xZg5V7QCve1ci74y65oNVTpXzAOtVIcpxammVqxJtT5XfWXWkaLwbM71O8onPFHtXx82j851K1o7qsQ3ezAL5L/XvS/mDHhPKFRH5RGaA4VJeq1m1Mge9YUpNsBkFpMPBgB6TV3SpYiJp5BEa0gosSOKiICxbhcOUwjXKuFwoSJUJjJDSRFLIXDhi+AUIdmRBxRmgcFvpjI0oon4i6QYlWOAgV52uC49oSxEVox4dpIMB3YMPDqpyhOqiwoTQ4YAEoOmEUusHFEesRwCWoLDFNxIaJTEimSiREi4TIXxn+QDfGY3CRjarIDVDgCAcEhiZqKjSJIlJgAQ+obgEesEAKntefKqpAfX/40x34iJUrva40PFRBGaHQkECi5QjSs0sfgyhHP4gwCQas5F9EKcOOJJEFqZQVKFmpCD/SIpaq3IVjTmFLUOBSlkYI5S7RuBUmDRMCs7oKLXfok192JZlCEOYyj0ITY04TmjM6Zhx9EsOKWHKacXglER9wTVBqEwIoEdI3jolNaQKGI1xixy6xeUmnIE1QH3HMldypk3SiSp5LsaRjSolP+oljn2HxRMT0kUt/FIUgQFvA/xIiUJc0Q2zGsMk3bVKjTcarBILQyEbdwUWPas6N4WjnPI4t07Z4hHQaI92EHlpKBdy0oRAqPUUeRgAamkKhCldIAAcE4wHCgOEzXvSp2oIAACH5BAkJACoALAAAAACAAIAAhSQmJJSWlMzKzFxeXOTi5ERCRLS2tHx6fNTW1Ozu7DQ2NKSipGxqbExOTMTCxISGhCwuLNTS1GRmZOzq7ExKTLy+vNze3PT29KyqrIyOjCwqLJyanMzOzGRiZOTm5ERGRLy6vHx+fNza3PTy9Dw6PKSmpGxubFRWVMTGxIyKjPj4+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAb+QJVwSCwaj8ikcslsOp/QqFR5SRBECI7oOBFwECJC4jItm8/Ty0TEQTkq73fk6IHH4SjthIzu+8sJFhx3hHAcXHCJhQ4cFgl/kJFGIyJui4qGiJeFKCIjkqBnFwQCFZibmUYTp6wOdxwEn6GzTCMIqKhzRh64p29wCLK0w0O2vbl0x4m+wcS0IxGt0ouHqtPXvw4Rj86QFyLY4YzJ4q13InzdZx5u5bjVRavKl5goHupl0O7hukW8+4QCVoggDF+TCfPcwSMiD+A1FBMMMvnm8NjCIf8SzkMnEcmIQRWxXRTSUKM4DgU7qpiAIqRFTS4fRlRJ0qTGkStjHnNwj+b+Spvl+hHJqFManJk0ERalBhPoTgQ+hyh1Kk0oRqrKtkSVirUVzpJLMWnFxw3J1LBWhRDtWmisOl5uVbFV9DVsIQsSp8aNN1cOub6J9hJJgPTPiJZxBHNdWhfwG8VCEjhAkVIUyGx4k5zVyMgCgT1I1Fy57BKyCsmG0qEBt8j0ZmwoLBSGMsFCKZuuCZl+Ala3kteLOpVFk0CERteIFfU0c/haZrOoUBBQ/WdUclSuzVWGEq3Xcy6LHEwfNsqVNNOoC8FJ+2StuQrf5SpCQP3ZLVboe812cuG2uNwVCDCcOgn495gSkvUiQH1MWGBSfPHQR9MF9zmQnzgQLjFCRbv+bUWAA1AlkZ44Ay7RnUMZbkXEdoslxB4SI+Km4hQxllMiEic61eGMgzn1YhE1ApUij3y5dGMRFerEIpGRdRViEiP0RQCTIrLlwJIqOFjUk1QakSRVQ6pgYEgLdhnamEAJoNlSR5p52lxHshYTl256yRadQlzQDlUCYOmmnl2hUB9wAIVZpwoE6OTAfnI6JeihVKC5TwV7SarRlJAqoaVTDqhJxAWBMpjpEICGBIdq7nG2I6SNAvTGciq0alIFbY5aU0xukWaTp7YqYWk5C3VlaK+bVuRAMTrt12s8SpKkk6jL5rlnRT0lStWP0QqhK0CYyrrPsMsWa1OIOboKa7b+1lyrLVa1ZrshVdX8qgy06ILqEq/o5qvvvvz26++/AAcs8MAE/ytvOPS6C8DCDDfs8MMLN7CuS35GKwIAGmCsccYcb+xxxgMIUa5JyuprAMQoo2yCEN4mBG6vAXSc8swpCGGtsTjp28HMPC+8gLNYJdzrBQpk3LDRSC+ctNEgCPGukQY/bLTSVGvsMKYqCPtvAA4nnXLHChCxrUb47kvB1FN/7HHDIQ/RsjvtjsoBxGmj3PEDQ3W16qEPoH201XU3bMCnoe47AgldW90zxlgLcTAurrzsZgmL80yBEW8rU8Gj9VLwd+A818wsVuLli0HlM2twbBGlUsX5sgkgzrD+zKiTsF3m4oCYbQiKo+7wAWaxuWwEvdO+uOpJPB5OmaOO0IDvKReg6Vx7b/VA8b0vvoESUS51rpsoQAC67xqUPMSXFI+KggZLkw/8EkE6VP1W4UPvMLZDjAzQ/CrWb3zPHXBC/DaCLgGML3VlU4L+snIoLBkwezNjABSedpxDwcVX/7Pb/MQVDvRwRCUUSkSYHJDBh4kOCq0LR5iUIqCOFMg3ySshwwpQsb9g40JxkFA3KNEK0zzwgE0rwwLFgqDgjIcW1pmGD0soQeZchxUrRIUALCA0KYziNrhYYvYU0Lgp9EYROJyGheImwEq4TAkkrFsQV9PD35DNEWWojQD+hIRG9jHshGi4wLbCqLk4RMACHqhVAjxggQiQDj51zNgJauiEKN0hikthT6p0skQS8G8JDeFjTNhzM8f4cHWSuGCV7CJJx4BRJeZ7k10qgCdErRKGPBqgS0r5ylPOSJZUaWUna2khFSWolq2cpCejgss5HWGXpoxDKofxy2Sy8pjOJMT38EGovkiSl4pYpjM+gk1dRrMCKJnRN5ypS2x+kEfsMGUwk8kTM33EMZx8ZTjrlM5I2pAt0+wSD9kST+oxkkf6wMo1u0KQfCUAfS66J0CawS9j2GSgrmLov0YgCI1AdB5T/Ge2ijMtVHhTHMIpGBcqOo2LekUE2hSpGgQj0dFnGuFDp8gDSqso0iNU4QoIEIBgPMABAYDhMzStqVCFEAQAIfkECQkALQAsAAAAAIAAgACFJCYklJaUzMrMXF5c5OLkREJEtLK0fHp8NDI01NbU7O7svL68hIaEpKakdHJ0VFZULC4s1NLUZGZk7OrsTEpMvLq8hIKEPDo83N7c9Pb0xMbEjI6MrK6sLCosnJ6czM7MZGJk5ObktLa0fH58NDY03Nrc9PL0xMLEjIqMrKqsdHZ0XFpcTE5M+Pj4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABv7AlnBILBqPyKRyyWw6n9CoVJlREEqJT+k4EXwSJYIiMy2bz9PMpPTRnBbvd+QYgsfhGu2EjO77ywoYH3eEcB9ccImFJx8YCn+QkUYmJW6LioaIl4UaJSaSoGcZBAILmJuZRhOnrCd3HwSfobNMJgmoqHNGIbinb3AJsrTDQ7a9uXTHib7BxLQmEa3Si4eq09e/JxGPzpAZJdjhjMnirXclfN1nIW7luNVFq8qXmBoh6mXQ7uG6Rbz7hAIuiCAMX5MJ89zBIyIP4DUNEwwy+ebw2MIh/xLOQycRiYlBFbFdFNJQo7gPBTu2mKAhpEVNLh9GVEnSpMaRK2MeO3GP5v5Km+X6EcmoUxqcmTQRFqUGE+jOBD6HKHUqTShGqsq2RJWKtRXOkksxacXHDcnUsFaFEO1aaKw6Xm5VsVX0NWwhDBKnxo03Vw65von2ElGA9I+JlnEEc11aF/AbxUIUnNCQUhTIbHiTnNXICAOBPUjUXLnsEnILyYbSoQG3yPRmbBowFIYyAUMpm64JmX4CVreS14s6lUWjoIRG14gV9TRz+Fpms6g0EFD9Z1RyVK7NVYYSrddzLotOTB82ypU006gLwUn7ZK25Bd/lKkpA/dktVuh7zXaS4ba43AsIMJw6Cvj3mBKS9SJAfUxgYFJ88dBHUwb3nZCfOBAuYUJFu/5tRcAJUCWRnjgDLtGdQxluRcR2iyXEHhIj4qbiFDGWUyISJzrV4YyDOfViETUClSKPfLl0YxEV6sQikZF1FWISJvRFAJMisnXCki04WNSTVBqRJFVDtmBgSAt2GdqYQAmg2VJHmnnaXEeyFhOXbnrJFp1CZNAOVQJg6aaeXWlQH3AAhVlnCwTodMJ+cjol6KFUoLnPAntJqtGUkCqhpVMnqElEBoEymOkQgIYEh2rucbYjpI0C9MZyLbRq0gJtjlpTTG6RZpOntiphaTkLdWVor5tWdEIxOu3XazxKkqSTqMvmuWdFPSVK1Y/RCqErQJjKus+wyxZrU4g5ugprtv7WXKstVrVmuyFV1fyqDLToguoSr+jmq+++/Pbr778AByzwwAT/K2849GZrr1OebquRn9EGqZAQ5ZqkrL6puqOLtwmBSyxWIVprLE76VrwPpr0BlHCvoGLV07tG/itxQsII+y/H7hDhsDv47isAVgvhPE+7oyqgk1sZJ7TqoUKLA+vCIT2qb6lUUXcwLq547OaHMfUca0wLSK3w1djslTJnmGYrMlX7UR31yl26DZTYRDT9VLZfcmgWm8vOvM/FYhZV5qj9Ca7pXEtvZTeGSkS51LluEmqSn3k7BfGMkpfTod9K95r5MUS3YPJx0X4+DclGcF42uqZfEjrFISXeUf6YrWOC7SR618kBBBv8ptHrQ4gbDnocqWTCAQAk37tmG0kht3O+Bwg8JBFQkHwHykePC93tNV/lfHD7McEIyZePPQDLQ3cN4EyMLhaCwY1HSwYpXADA+effj772rNyu4XWsoB0qBICB8EHBBB4oQPn0t8DrpQ88rKAMGs4GhwthrQTTU0IEUEAC8zXwgx14oHwIAbkpcAxA8yBgBofwgQCw4HoM/CAIRVikxFRnWxYshyIigIEQ1CoCBgiABBCgv/zJEIYxDKH2BueHKN1BgEthDweOSEUkxtB8NGSIKy5Hm8DADy1H4AD+qmhFIxrxflmUCvvMAJcv9kWKZCyjB/7HmD8ldoR9qjMJnlqQgisysI4ejCMamZRHgMCxgWYMpB9heMY0dqSQegxjIpOoSDLW0ZFkMY9jFrDHPh4RkIL8JCadAUmHdBKQkwwlIs3nNQJp0i6J6KQMz6hKECbPAD6pnY8kychaChIBx4rKR2B5B1n6spYPkN0svrHJN+xRjHM85hFRwMW3TGsuxpRmFRFQATN9xDFSpKM2FwiCtJmJHW8M4zhliABcZooSUVSnFaXZAQuskUr6wMoh51lLByiTRwqoXFDkSUtBdsCf/TKGTfa5SCp24ADmTKggNHLIgh6RAh64p76Kc01pnLKSH7wACv6Zr9rsLA4MneUKUCoQzIItQQ2C6OhHY3iBlV7JpWWowhUSIADBVIAFLHAAChogAI3i9KhDCAIAIfkECQkAKwAsAAAAAIAAgACFJCYklJKUXF5cxMbE5OLkREJEfH58tLK01NbUNDI07O7sVFJUpKakdHJ0jIqMzM7MLC4snJ6cZGZk7OrsTEpMhIaExMLE3N7cPDo89Pb0XFpcLCoslJaUZGJkzMrM5ObkhIKEvLq83NrcNDY09PL0VFZUrKqsdHZ0jI6M1NLUTE5M+Pj4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABv7AlXBILBqPyKRyyWw6n9CoVJlREESIh+g48TwQIoIiMy2bz9PMRPQYWEKWt+Vx/MjvA+2EjO77ywoXD3FwcHdzXHF3hYoPFwp/kZJGJCJuh4qKcHRGdoaYjBYDIiSTpmcZBB6MhqxyIXl1mm8DhZehHhd8p7xLJAiYs7SwxIidr7XJocIWCKW90ES/hG6uw8rJnEV218TKIbaHztG9JCmhrdje67HH3eoDyq9yKZDkkRkimZns/djaRLj5G5hsH4Jd98x8qDUPHDyCsAAOEfiwYqFQAz4kLGPu0zuI8CQKoQgSopwHzzY6mcDvo0V4xrZRK/ky0wSVTPLNc0mzmP7IFSRfmgx1ECcSEg889hTaTiZPpuzuoDRaZMIlZEsh/gya1aKim1SFsEzXlWDMgDOhQr2jMewKq7bKWtyaVq5Je2GtPpV7dmJdtTSbuZ1YDbDQviP/2lUneDDhvYZD0IVs9wJOvHUKL/Y2eXNFyyrtbEmykDJTxEAVR1YHeuNYC60zmzbZeTVBBEoUgI1E4mqI2J00265V2zMx4EUUiErZJ0PSQ6ORlJbr6MMYJFU+CBJeFjkR5W8eIDyjT9hvJdOhOsIMJVC87rmpNUYzAR0tC9Flg3z0RwEC7hZ5N4RyrcTRlhm9aSLPGwKOBCAsA+hiSgYXPIhNgysQuKAFzP5JkQJWG+YX3DsS9pJBev1gqOE6cfzkBDc8yYEhiiWSkwEwKcY3kIFprAIZg+i5MQB79yiQlDIq7iXKeE1c8IlJcYi4TVFU3UhLkiXBFgUJCg4VpWNLLIRbEivWZAGRSpyj2o4YgonmgGvKs8kT4MW1Fn5gTlGnWnG8aYSasy0oZZ7xBQoOakaAZ6ighDahaFd9MoHjosVE2iiZhFA631Fd2hbCgZcmmuliHRbhZJwgbRpqEcCgKhSGHoDY1QBMripEBhYuNUASLLkKkZ+27smXBaASMeliY9qaBI7DwZEsEbj6WhGtyuaW62nUVrWIbcVWa0SFlDIUApHlLZatt/7YXZvqs0LEGi4sbaILrl2iFJGBnbPWii606gqFEIyV7SuptFERS4Q++PIJrMAZvussEYO86yLDRLy3mhsAEQxPvAxf4PCuQnD5bkYUL1EmpPZwZZi+Jd/a745tEZBwYBO3LETEfIHWasA2J+ExvWN+GK7BPUun8TpjDkLvwi2fbBgn7trFcs8ZHF0QyEVnrfXWXHft9ddghy322GQzHGuBi2Sa9htT21w12nCr3QonEQ/T5d3UMF2yyHbPhPdJQgDa0uDMdKv1Bx6pzYzinCD8RlyPVxP5KxxT/HND4toN+ZgeK8kiLIgWXbdcoI1lWxxtUxztzIe1Jexqu22tAP5Zhp05hNXeVL5v54tB/G69XUdtG0AID2e77LLy+azKPanac7mng3pvs/Gk7i2urNPE3i2rvUGA1gR0mpVIxZcVx7ktr94scszfqXuoAA/XbbTNLum2uMOhPwSzQNvc6sjsGkKvFmMphhEIdwwxnBCEE5nwWC9PGfDRyLB2BN7BAzABVFZ5RnaeJHCJJjVRYKheM7JSsepiLDoeupy2FOeJamRAYhiKIqM3pa2vZTPsSQaP8LqsvK9RCymL3m42nB9eRkcYbI/VdkgoO8zoZfEY4hAsSBMMDQAEJryHleDwRMoYUX1MYeIKHgABAFCgZrxQgLsI0UWtPNAp7NiYEv7ICIA6bsAAUkRDJTDXQelcS4RMsOFt5ljGDdQRABsYgQnemAYCMEQ+ihjUY/whRiYkiCBWLKMdD1nHAkQgi6hwZEsuIqMgvWNIaPDEQ6w4gk1u0pB1HEEFUtAfS1jDGwXpo36UkUeffQRDdOQkLA9pSFiqgANoJNMFzraPGH2JNJoxInYEWQtgarKYnMymKwGQAAlw4AA1U4B2hKaU5H1OS9B0YCQUwD1ravOd2hzmIRtwhPDdcluB0WVw9NcHgWTylYgUJjwBCgB6GiF8zZxFViKZG0AqBJ1ICOZAASpPbRq0CPZsCL0MIcloADKY2JRnRYkJz4sSAaHGYYw0e/4h0YmGNKABrahJhyAzBJpFn27xQAJiylOSTpSgMxWCPanXj/t0dCM6/SlMselTkRa0njatCRcHk1SejlSpAq1jUFdQ05TuqJeReMBOf/pSrM4Tqhz0CtGoUtWrwtSs2dzAVmUGRUg5lBwXKAE8h8lUuD71oOYk6gPAeooMOMCp2/TrWQGb1hQxkhwhSABi36rYudLOMyRbFQE6sE23mnWuUWXHYL11gLF6Fq6WDW0y7pqnCYDgtKhFq2dg81jHiKABlFXsXzF6WcMggLB5SkEDNgDbvYIWWcC9FAEMUNx3pnZRVPIaASKwgOYuFqMac0RtKZYCB2CguHKtZ2/jyDefshXBAgHQAHEHCtqnVMe8vrCAAzSAAYuKNy15eMR2zUsCD5jAAQ2ggAO44AUEXMA6+4Wv2IIAACH5BAkJACoALAAAAACAAIAAhSQmJJSWlMzKzFxeXOTi5ERCRLSytHx6fDQ2NNTW1Ozu7Ly+vISGhExOTKSipCwuLNTS1GxqbOzq7ExKTLy6vISChDw+PNze3PT29MTGxIyOjCwqLJyanMzOzGRiZOTm5ERGRLS2tHx+fDw6PNza3PTy9MTCxIyKjFRWVKyqrPj4+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAb+QJVwSCwaj8ikcslsOp/QqFSJURBIiQ7pKBF0EiSCAjMtm89TjITUyZgW7zfk+IHH4RmthIzu+8sKFx13hHAdXHCJhSYdFwp/kJFGJSRui4qGiJeFGSQlkqBnGAQCC5ibmUYSp6wmdx0En6GzTCUJqKhzRh+4p29wCbK0w0O2vbl0x4m+wcS0JRCt0ouHqtPXvyYQj86QGCTY4YzJ4q13JHzdZx9u5bjVRavKl5gZH+pl0O7hukW8+4QCLoAgDF8TCfPcwSMiD+C1DBIMMvnm8NjCIf8SzkMnEUmJQRWxXRTSUKO4DgU7qpCQIaRFTS4fRlRJ0qTGkStjHjNxj+b+Spvl+hHJqFManJk0ERalBhPozgQ+hyh1Kk0oRqrKtkSVirUVzpJLMWnFxw3J1LBWhRDtWmisOl5uVbFV9DVsoQsSp8aNN1cOub6J9hJRgPRPiZZxBHNdWhfwG8VCFJjIkFIUyGx4k5zVyOgCgT1I1Fy57BKyCsmG0qEBt8j0ZmwZLhSGIuFCKZuuCZl+Ala3kteLOpVFo4CERteIFfU0c/haZrOoMhBQ/WdUclSuzVWGEq3Xcy6LTEwfNsqVNNOoC8FJ+2StuQXf5SpKQP3ZLVboe812guG2uNwLCDCcOgr495gSkvUiQH1MXGBSfPHQRxMG95mQnzgQLlFCRbv+bUWACVAlkZ44Ay7RnUMZbkXEdoslxB4SI+Km4hQxllMiEic61eGMgzn1YhE1ApUij3y5dGMRFerEIpGRdRViEiX0RQCTIrJlwpIqOFjUk1QakSRVQ6pgYEgLdhnamEAJoNlSR5p52lxHshYTl256yRadQmDQDlUCYOmmnl1lUB9wAIVZpwoE6GTCfnI6JeihVKC5zwJ7SarRlJAqoaVTJqhJBAaBMpjpEICGBIdq7nG2I6SNAvTGciq0atICbY5aU0xukWaTp7YqYWk5C3VlaK+bVmRCMTrt12s8SpKkk6jL5rlnRT0lStWP0QqhK0CYyrrPsMsWa1OIOboKa7b+1lyrLVa1ZrshVdX8qgy06ILqEq/o5qvvvvz26++/AAcs8MAE/zsBAAgnrPDCDAOwgZ/R2uuUpwM4bPEGF2eM8cYJr2prkAoJEUHDJC+8MQUBp+qOLgxgXPLLCAcQsHEuhegAzDh7EHC5JmFKgcUIuyx00EQrjAC9y0oc0kwXMDw00EO7DAC++ybokjAIJCw1zkDL7C/NnBJRsdYalz30BP8KgNVCJxTNNdAIY2sroQm59TPZTz+tMMYV9OutRrBKsPXbC48A8aGgdkXdwXAT7rID+34YE9UqtO024Qgbnm9/Ou2VAeZOY5xCvtbGtB8GIzQOOgAjtGvmYaEeUcH+5ZhjfEC2f7sDIhICrN7wBnJTSfc+ygpRAO1vuzzB4TNy3hXlRHCAPOh9j5q7RmEK7rvWLhsw6vDzXLnEAdPXjimk4IeDp5flc43xCb2mj4vrKoy8fcLVx2+eScELAcH9CINftuTHCvqJTHVvE6CbsETAO/RvCCQYXAIP9SEAzYN5Q2ibBF+mQC5wRCUYgIAJKGCh32xECiU43gYb1kG5dMqAkSiQK8yTvWM8Sgp341oL+TLCx2AQDRTpIQnhYEFpFK8JI1thwnbIEFeQMA7SQRoQCXCdUxSxEA9EAgGyxkETOnF/eBiPJKxzjCsmgjJo+NkKmciVHvbQFySA4RL+ijMt75jwFEeEguUYxsaaCBGMd0iEABxRhtqoDUV3TIxhUDC4Pv7kj+GDwAU+UCsFfOACInTJG2oIhzL9YYsKcyRC3PjFcGCCPSrDSm7EFwkTuEyUbiThEx2yvtI5xjXn+oMBNpA/8MzwiW/k31/sQkSVQK+NfxwiUGpJTN8QaZSynCFWUOkYK/IoQV8MZkiYWU1nRsVq0ozDNIfZzWL6JEYUgIMyXYLKZrYij8MApztrWU5C5BIfDaxIO+t5lK18xJ1voCdAF4CS5oGNmNx05wd5xI5qri+Vmrynij7iGPbYkjE/7Agv+kLNsNhjVJRYikXD4oll6WOcuygKQfJYpYAv7aOjTmkGv4xhk5HaBEQZhVQJbKORfbpjkDntVXEAWRVyTkM4BeOCIHBh02noIakTWYMA6jgQo05GD1KE6hFKIIErQEAAgvmAAAQAhs9kVatoVUEQAAAh+QQJCQAuACwAAAAAgACAAIUkJiSUkpRcXlzExsTk4uREQkR8eny0trQ0NjTU1tSkoqRsbmzs7uxMTkyEhoQsLizMzsy8vrycmpxsamzs6uxMSkw8Pjzc3tysqqx0dnT09vSMjowsKiyUlpRkYmTMyszk5uRERkSEgoS8urw8Ojzc2tykpqR0cnT08vRUVlSMiow0MjTU0tTEwsT4+PgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG/kCXcEgsGo/IpHLJbDqf0KhUqWEQSglI6Uj5QBIlAkMzLZvPUw2lBBm0Iu836wiCx+EDLYWM7vvLDBcQd4RwEFxwiYUtEBcMf5CRRiglbouKhoiXhQMlKJKgZxoEHxGYm5lGFKesLXcQBJ+hs0woCaioc0YguKdvcAmytMNDtr25dMeJvsHEtCgsrdKLh6rT178tLI/OkBol2OGMyeKtdyV83WcgbuW41UWrypeYAyDqZdDu4bpFvPuEAkZgIQxfEwrz3MEjIg/gtQEUDDL55vDYwiH/Es5DJxEJikEVsV0U0lCjOAgFO7qgMCCkRU0uH0ZUSdKkxpErYx5rcY/m/kqb5foRyahTGpyZNBEWpQYT6M4EPocodSpNKEaqyrZElYq1Fc6SSzFpxYeTa1g55LpeGqvuAIcNSqYu/XoW0wWJAzgAABAgrtpEVoUQ/fuGrREGSP8QQKB3b98kcrHSJZzIcBEGLQakFJWicePHSCK7Y3SBwB4kaq6AxGqZCGZD6dCo2EsbgF64kDUOuJAYCoULpWy2NhtneJQItmvTfusXWydufRiU0Gh8ZUtCPc2AQKBcOfPc0gYQiP1n1PVr1cHGabEZyonky73jDr2oxfhho1xJq/66EJzAT4zQXXzLzccFIQmQ98wtrPDXS29OoFCAd/BV+B19EXwAHT4M/gRXmRKY9fKBgkx0sFdjFMoXV4I0acBgCw6KcxcUJaAYH4o22mbgVkcQAGNz82zIxAInDgifXjaCxuMRQsZznjIAIsFChUXmOOCFSz4hmjJNIjGBkUV2l6OSWS6xpThRFpFAmMlZKWaBZTJxZpBMGOAmlUbiSECckLXjFFRKgPDAm2CCiQGfGGLFnhISUOlZod6dgCgS0xU1IxIh5AmpcgW0NykKHlL1QRIfWIjnphykOemc+3Tpgghg3jmgAZMuwYJ+VLWmgQUUyjogCRDWSgQKuIY0gIJ51eYrmAoIu4SPLrkC4WyEbroXCZ46KwSoMUVgWQM3Wqtss9oqMR1W/qMydOqytQFbLhXFAhWbgMqKW5sI7y5RKVXZuTCbjewqp2q+rO7ElgD12rtXBfky8QFVESy0QrWoktmwEedW5MoQBJiqMADpXkzfCEDBIQtyKYq7QrYiaxDvaBHMpEDCCnsg8hIPU7WnCw7kGPCJFt9MxL4VafUlgQqPIDR4TukiAMAKc1DdzQWLJEQFSNvLAcs3E+tSyEuHLfbYZJdt9tlop6322my/G6pDJIbt8tdCrFYR1yL3V1E10VAVbNiDAaQLOFRdWvYFWAFKQLRlLd13SDurB1DcN7uMVU8o6OTqzXoDJUxXhotNuEtE2G0T2GI/7NJCozu1ecMM6MRW/uAmTf1u6xX1OzdVx4qtgZ8hkfe2Rq6ELjK0omLcbe9CazA8QJZJTvzONy/eFYS/d8X8xdnHtP3QOrUA6MUvujSc9AC9jmjnIf3twvMmjZiv80WhXgTiRdmeJe5OGT8sYf0SVtWUwbXyYQVvSxogepjAPqDoL0sK3IT6hPA4pzywTBE8ReMuwxqhZfAOExxCBfdxQZWw7IMDgULmhOMsXqRHIyEkAv4Swh+OqMRFifAfcbBRQiF0Txk6rEmGYhiJDhHihc6hXKA2AiIEKTESlGgFElHhPiaMcC1NPIV4nogG80xjiqwY2BJQ8CRWBPEn0vjABbgohVEEBxdgvINm/tCAvh8loYG+KAERlyAd4PXijFsKYBn4B4c4YkONe2QIcIACyCOWx3TeymJCFMGCC4DgdQwAwQVuFa0INBIO8vsDse7wSbUAiHay88uiItGQGP0FQNarix2RkMlQuFCSSzklZRzZkSrikSrjI0Isd1nIOP3SJbqUpSJ6SItjArNHyuRlVEKkzGBeJZrLnCYx72BNIQwTmy2o4jCouc0IdNMFyAOnIPGBQo2cEpxH2cpHsHnOdBITJUv6RjnriU0bZokdxDwnKhW1Th59ZJewlCU+hQXQXKZlKQXlUxRNCc2/eOJi+sDKO7tCkKUxwID7SOafEKgtY9hkowARH0nzQoUCQbiTDgBR40o5Vwll1HMez2mbKlw6DZRuQg86XYIaBOFHc/ZoEXkowWmCGoUqXCEBH2gNCCDwATCYho1MZWoQAAAh+QQJCQAoACwAAAAAgACAAIUkJiSUkpTExsRcXlzk4uR8enxMSkysrqzU1tQ0NjTs7uyEhoSkoqTMzsx0cnS8vrwsLixkZmTs6uyEgoRUVlTc3tw8Pjz09vSMjowsKiycnpzMysxkYmTk5uR8fny0srTc2tw8Ojz08vSMioysqqzU0tTEwsRcWlz4+PgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG/kCUcEgsGo/IpHLJbDqf0KhUKWqQMAXK5CjZNBAgguIyLZvP04sJc0oA3nDOsWN61O+CBkhCRvv/ZRsBAxlwhYcAGXJGdHaOd44NFQqAlZZGIBgWb4WJcJ8Ai0WNkKUmeCAil6tnEhoUnJ+dnZ+iRBKPuXW6Dw0EqqzBTAQeELGetKBxXLylvHYIwMLTQxUFs8rZx7ZDuM7fj6XR1MIgDobaysmhzODuvCXS5H8KC+vpx8hv3ELezf/fTCDoM+/MhxDo1mHDJoudEX/vIj4S0KFgGQIR0GW7l7BWO4Agv8WzCOVBAkTaFupr6LAIxJAwHzwQIIEkkwsjPKXjiC8R/j8UBCQKDXcHBEGbRQhQ4JkPEVOPD2EO3QWpgTykKAS42amxJyhFR4JKHWuqJlYhGyDco5UMpVewUaeSzVXxbFa1Xdl61fYzqNy/dupQsivAGEudT1P+fAlYoh0QdodsyMAw8d6+jedCjiyZo+Wdi+cCrmBzMJLJK/fiwyx67GaLdF4fQa36bejMEmXPk1BUCerPXjHjBqi7iAKzlUQIeFScyO/aij8Od9Z8iAITAq6eudAAkh3SSZ5D9xmAxAbtQi5IIACixPTHSnjbaXD0DIhm1dG67WkgwIYyEoCwQWsm5IeCBMv15gdjzPm2nzIJTFACIAGe4lp839RlhnIg/oGHhAmUaROCBshVcgEBAghlIIK52JHdGSXA5OERIK6TAAPoJYfiOyu+M2EZpABUx4xG1MhJASVOI8J936yY4D9JOnHBgFMZOFkGBvxnUxel9BiSAPU1UcFoSphQQI7kiOAefEkwCA6RTIhAoIGcASWQEteRZVoTMWYGZ51EoHkgYD82kSdudAJ6xKFz7alEnwSyqaihuBWK53tDTsqEfLg5egQCmNoh6KSMZobAEiKEagIBmiZRKoEmCDpmpJCc2ioSoNLqyJ+S6VrHBmHemh6VumopHa2eCmtdqMmiwKSutiqLK6bREnFBisWOKuy174H5EKa8SjsEAb6aEOWz/rh5K24SU+r6QHHE4sbqukrMipsJxqbXbbD0DsFtpHYcFWRjBfa7BLqi1aGhs+42a3A/78nWHa35Pjybrg0Q8V64FqNgL6xDyDldlB134yswbpLFb8n/4lYXucNZWrIRE8srBMJkzozEx43ZCinBC+t8i64/1kygwzOLHGnGKMTb2sozq0Gx0FRXbfXVWGet9dZcd+3115M6DRjULE+npdGNaWvxq38x/XNrJAs9sGg/4jwXxyXzLJqtMMPKNNZvAzZvylOR/bAa09WldKdYsz2XNBtjbfdfRKAtWsVCbzDd3wxPh7TBCvgq29yAJUrv5GQtLPVw6urccqT1iU3W/il4ryvWcJijPtRMhivb7nTFES7Vqjr3PVyUr2fW+uHYsh6s7sNXa3CuwCMh/FSft+o4YHE37esDwBr8e7H1hmo6oNBPxXGq35sQtLKc6joq9Sf3G39miW6v2cP3i5Y9CoETzfkm1b+pcO5StBqgpgoIk/8JIYBDUSBSBMVAH0FhcWSRoE1igyE9RUFvucGTUc5yAQTsqoMqkkLyOtTBDTjQEgrQXIPaJJTlPYF0+EHgHQZSkCXlkIYg6R4TIJgLA7FNAATonRlO9KQmoRAeZ+DQOzhWQfBVQIlQOBGVIuIlZ7yoFcTRoZBA8MIlKAAEzZPRE+/wvilMrotS2cAk/gBUARnmzHpdAgR3qCPG3d2hBBXoANIU0IEKrOleD6DiHcIHiFRBQpHtk5kQcFg9GsbqEv4woqoeIEmgtE8XRmyjHzjoqk2aoJOUFB1WhKg/U4Xlk04klSntgMpZ5hFQrYyU9IRgPFjOMDLXseUDdomCVKpKgzAUZh2I2UtlCnEawfRlrcKizEeIcjfVPOUcpKmLZ6apAdxcJjXD2Qu1keMCIBAmM8k5wkl1II2hIqYxYXXNyFTBlJ1spq+sIq53qqqWsKznpHyIqXx+MhUWU5OvUPm9kcxMAfQj1BymM46qiQBUjWEowSqKNRFUwHIR0ShZ5GjOh6JxKMycigDIMQg2l3w0pNuMiB68+TX1fBSewxxnKfKwByy21F8KYA8CNtCcDjRgA2AgAB9+ylQmBAEAOw==);
            background-position: center;
            background-repeat: no-repeat;
            background-size: 50px 50px;
            content: "";
        }
    </style>
@endsection
@section('pagetitle')
    <div class="d-flex justify-content-between">
        <div class="pagetitle col">
            <h1>{{ __('all.Prodacts') }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>{{ __('all.Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('all.Prodacts') }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a class="btn btn-primary" href="{{ route('prodact_createnew') }}">{{ __('all.createnew') }}</a>
        </div>
    </div>
@endsection
@section('section')
    @include('Admin.dashboord.prodact.showimage')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card p-4">
                    <div class="card-header">
                        <div class="row mx-2">
                            <div class="col-sm-4 ">
                                <label for="inputEmail3" class="form-label">{{ __('all.Categures') }}</label>
                                <select name="categure" id="categure" class="form-control">
                                    <option value="">{{ __('all.selectoption') }}</option>
                                    @foreach ($categ as $item)
                                        <option value="{{ $item->id }}">
                                            {{ app()->getLocale() == 'en' ? $item->name_en : $item->name_ar }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-sm-4 ">
                                <label for="inputEmail3" class="form-label">{{ __('all.Status') }}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">{{ __('all.selectoption') }}</option>
                                    <option value="active">{{ __('all.Active') }}</option>
                                    <option value="inactive">{{ __('all.Inactive') }}</option>
                                </select>

                            </div>
                            <div class="col-sm-4 ">
                                <label for="inputEmail3" class="form-label">{{ __('all.Condition') }}</label>
                                <select name="condition" id="condition" class="form-control">
                                    <option value="">{{ __('all.selectoption') }}</option>
                                    <option value="new">{{ __('all.New') }}</option>
                                    <option value="featured">{{ __('all.Featured') }}</option>
                                    <option value="hot">{{ __('all.Hot') }}</option>
                                    <option value="cuts">{{ __('all.Cuts') }}</option>
                                </select>

                            </div>
                        </div>
                        <div class="search-bar mt-5">
                            <div class="search-form d-flex align-items-center">
                                <input type="text" name="query" id="query" placeholder="{{ __('all.Search') }}">
                                <button title="Search"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-5">

                        <!-- Table with stripped rows -->
                        <table class="table " style="width:300%" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('all.NameEN') }}</th>
                                    <th scope="col">{{ __('all.NameAR') }}</th>
                                    <th scope="col">{{ __('all.descriptionEN') }}</th>
                                    <th scope="col">{{ __('all.descriptionAR') }}</th>
                                    <th scope="col">{{ __('all.price') }}</th>
                                    <th scope="col">{{ __('all.Quantity') }}</th>
                                    <th scope="col">{{ __('all.Categures') }}</th>
                                    <th scope="col">{{ __('all.Condition') }}</th>
                                    <th scope="col">{{ __('all.Status') }}</th>
                                    <th scope="col">{{ __('all.Size') }}</th>
                                    <th scope="col">{{ __('all.Discount') }}</th>
                                    <th scope="col">{{ __('all.Image') }}</th>
                                    <th scope="col">{{ __('all.Video') }}</th>
                                    <th scope="col"></th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src=" https://ajax.googleapis.com/ajax/libs/jQuery/3.3.1/jQuery.min.js "></script>
    <script type="text/javascript">
        $(function() {

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                pageLength: 0,
                dom: "Bfrltip",
                lengthMenu: [4, 10, 20, 50, 100, 200, 500],
                ajax: {
                    type: 'post',
                    url: "{{ route('prodact_list_post') }}",
                    beforeSend: function() {
                        $('table').addClass('loading')
                    },
                    complete: function() {
                        $('table').removeClass('loading')
                    },
                    data: function(d) {
                        d._token = "{{ csrf_token() }}",
                        d.query = $('#query').val(),
                        d.condition=$('#condition').val(),
                        d.status=$('#status').val(),
                        d.categure=$('#categure').val()
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name_en',
                        name: 'name_en'
                    },
                    {
                        data: 'name_ar',
                        name: 'name_ar'
                    },
                    {
                        data: 'description_en',
                        name: 'description_en'
                    },
                    {
                        data: 'description_ar',
                        name: 'description_ar'
                    },

                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'categure_edit',
                        name: 'categure_edit'
                    },
                    {
                        data: 'condition',
                        name: 'condition'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'size_edit',
                        name: 'size_edit'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    {
                        data: 'image_edit',
                        name: 'image_edit'
                    },
                    {
                        data: 'video_edit',
                        name: 'video_edit'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        width: "150"
                    },
                ],
                language: {
                    'lengthMenu': "{{ trans('all.datatable.lengthMenu') }}",
                    'zeroRecords': "{{ trans('all.datatable.zeroRecords') }}",
                    'info': "{{ trans('all.datatable.info') }}",
                    'infoEmpty': "{{ trans('all.datatable.infoEmpty') }}",
                    'paginate': {
                        "first": "{{ trans('all.datatable.paginate.first') }}",
                        "previous": "{{ trans('all.datatable.paginate.previous') }}",
                        "next": "{{ trans('all.datatable.paginate.next') }}",
                        "last": "{{ trans('all.datatable.paginate.last') }}",
                    }

                },
                'columnDefs': [{
                        "targets": 0, // your case first column
                        "className": "text-center",
                        // "width": "10%"
                    },
                    {
                        "targets": 1,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                    {
                        "targets": 3,
                        "className": "text-center",
                        // "width": "30%"
                    }
                ]
            });
            $('#query').on('change', function(e) {
                e.preventDefault();
                table.draw();
            })
            $('#condition').on('change', function(e) {
                e.preventDefault();
                table.draw();
            })
            $('#status').on('change', function(e) {
                e.preventDefault();
                table.draw();
            })
            $('#categure').on('change', function(e) {
                e.preventDefault();
                table.draw();
            })



            $('body').on('click', '.delete', function(e) {
                var id = table.row(this.closest('tr')).data()['id'];
                console.log()
                Swal.fire({
                    title: "{{ __('all.massegdelete') }}",
                    // showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('all.Delete') }}",
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData();
                        formData.append('_token', "{{ csrf_token() }}")
                        formData.append('id', id)
                        $.ajax({
                            method: 'post',
                            processData: false,
                            contentType: false,
                            cache: false,
                            url: "{{ route('prodact_delete') }}",
                            data: formData,
                            success: function(data) {
                                if (data.status) {
                                    table.draw();
                                    //  position;
                                    if ("{{ app()->getLocale() }}" == "ar") {
                                        var position = "toast-top-right"
                                    } else {
                                        var position = "toast-top-left"
                                    }
                                    toastr["success"](data.message)
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "positionClass": position,
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }

                                } else {
                                    if ("{{ app()->getLocale() }}" == "en") {
                                        var position = "toast-top-left"
                                    } else {
                                        var position = "toast-top-right"
                                    }
                                    toastr["success"](data.message)
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": false,
                                        "positionClass": position,
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }
                                }
                            },

                        });

                    } else if (result.isDenied) {}
                })
            })
            $('body').on('click', '.showimage', function(e) {
                var id = table.row(this.closest('tr')).data()['id'];
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}")
                formData.append('id', id)
                $.ajax({
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: "{{ route('prodact_showimage') }}",
                    data: formData,
                    success: function(data) {
                        if (data.status) {
                            $('.carousel-inner').empty()
                            var row = "";
                            for (let i = 0; i < data.message.length; i++) {
                                if(i==0){
                                    var active="active"
                                }else{
                                    var active=""
                                }
                                row = row.concat(
                        '<div class="carousel-item '+active+'"><img src="'+data.message[i]+'" class="d-block w-100" alt=".."></div>');
                            };

                            $('.carousel-inner').append(row);
                        } else {
                            $('.carousel-inner').empty()
                            $('.carousel-inner').append(data.message);

                        }

                    },
                });

            })
        });
    </script>
@endsection