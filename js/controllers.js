angular.module('Controllers', [])

.controller('MenuController', function($scope) {
    $('.button-collapse').sideNav({
        menuWidth: 240, // Default is 240
        edge: 'left', // Choose the horizontal origin
        closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });
    $('.has-subitem').on('click', function() {
        if ($(this).hasClass('scrollDown')) {
            $(this).find('.subitens').slideToggle(200, function() {
                $('#app-menu').scrollTop($(this).offset().top);
            });
        } else {
            $(this).find('.subitens').slideToggle(200);
        }
    });
    $('.openFb').on('click', function() {
        window.open('fb://page/369848703210986', '_system', 'location=no');
    });
})

.controller('navBottom', function($scope) {
    $scope.whats = function() {
        cordova.plugins.Whatsapp.send("11991446564");
    };
})

.controller('HomeController', function($scope, $http) {
    document.addEventListener("deviceready", onDeviceReady, false);

    function onDeviceReady() {
        var push = PushNotification.init({
            android: {
                senderID: "723585432484",
                icon: "icon_push",
                // iconColor: "#FFF979",
                vibrate: "true",
                clearBadge: "true"
            },
            ios: {
                senderID: "723585432484",
                alert: "true",
                badge: "true",
                sound: "true",
                clearBadge: "true",
                gcmSandbox: "true" //todo SETAR FALSE
            }
        })
        push.on('registration', function(data) {
            var device_id_local = localStorage.getItem('device_id')
            if (!device_id_local || device_id_local != data.registrationId) {
                var deviceData = { device_id: data.registrationId, platform: device.platform, uuid: device.uuid, registerToken: 'b93136f6223bb2d0fd8ba1a7ad153fec' }
                $http.post('http://aplicativo.comerciarios.org.br/app-data/api/devices_register.php', deviceData)
                    .success(function(success) {
                        console.log(success);
                        if (success == 1) localStorage.setItem('device_id', data.registrationId);
                    }).error(function(err) {
                        console.error("Erro ao registrar device", err);
                    });
            } else {
                console.info('device_id_ já registrado', data.registrationId);
            }
            console.log(data.registrationId);
        })
        push.on('notification', data => {
            console.log('On notification: ', data)
                /* Possíveis campos recebidos no data:
                data.message,
                data.title,
                data.count,
                data.sound,
                data.image,
                data.additionalData */
            push.setApplicationIconBadgeNumber(function() {
                console.log('success')
            }, function() {
                console.log('error')
            }, data.count)
            push.finish(function() {
                console.log("Processo de push finalizado");
            })
        })
        push.on('error', e => console.log('Erro ao registrar push', e.message))
    }

})

.controller('JuridicoController', function($scope) {
    $scope.openConvencao = function() {
        if (window.cordova)
            cordova.InAppBrowser.open('http://www.comerciarios.org.br/index.php/Convencoes-Coletivas-de-Trabalho ', '_system');
        else
            window.location = "http://www.comerciarios.org.br/index.php/Convencoes-Coletivas-de-Trabalho"
    }
})

.controller('EnquetesController', function($scope, $http) {
    $scope.votadas = JSON.parse(localStorage.getItem('enquetesVotadas')) || [];
    $('.loader').show();

    $scope.loadEnquetes = function() {
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/enquetes/index.php')
            .success(function(data) {
                console.log(data);
                $scope.items = data;
                var localDb = JSON.parse(localStorage.getItem('enquetesVotadas'))
                if (localDb) {
                    localDb.forEach(function(it) {
                        $scope.items.forEach(function(item) {
                            if (item.id != it) delete localDb[localDb.indexOf(it)];
                        });
                    });
                }
                if (localDb) localStorage.setItem('enquetesVotadas', JSON.stringify(localDb.filter(function(i) { return i != null })));
            }).error(function(data) {
                alert("Erro! Por favor tente novamente mais tarde.");
            }).finally(function() {
                $('.loader').fadeOut(200);
            });
    };

    $scope.loadEnquetes();

    $scope.vote = function(pergunta, resposta) {
        var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';
        $('.loader').show();
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/enquetes/vote.php', { pergunta: pergunta, resposta: resposta, registerToken: registerToken })
            .success(function(data) {
                $scope.votadas.push(pergunta);
                localStorage.setItem('enquetesVotadas', JSON.stringify($scope.votadas));
                alert('Seu voto foi computado. Obrigado!');
                $scope.loadEnquetes();
            }).error(function(data) {
                alert("Erro ao votar! Por favor tente novamente mais tarde.");
            }).finally(function() {
                $('.loader').fadeOut(200);
            });
    };

    $scope.jaVotou = function() {
        alert('Você já votou nessa enquete');
    };
})

.controller('EnquetesItemController', function($scope, $routeParams, $http, Utils) {

    $scope.votadas = JSON.parse(localStorage.getItem('enquetesVotadas')) || [];
    $('.loader').show();

    $scope.loadEnquetes = function() {
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/enquetes/getItem.php', { id: $routeParams.param })
            .success(function(data) {
                console.log(data);
                $scope.items = data;
                var localDb = JSON.parse(localStorage.getItem('enquetesVotadas'))
                if (localDb) {
                    localDb.forEach(function(it) {
                        $scope.items.forEach(function(item) {
                            if (item.id != it) delete localDb[localDb.indexOf(it)];
                        });
                    });
                }
                if (localDb) localStorage.setItem('enquetesVotadas', JSON.stringify(localDb.filter(function(i) { return i != null })));
            }).error(function(data) {
                alert("Erro! Por favor tente novamente mais tarde.");
            }).finally(function() {
                $('.loader').fadeOut(200);
            });
    };

    $scope.loadEnquetes();

    $scope.vote = function(pergunta, resposta) {
        var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';
        $('.loader').show();
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/enquetes/vote.php', { pergunta: pergunta, resposta: resposta, registerToken: registerToken })
            .success(function(data) {
                $scope.votadas.push(pergunta);
                localStorage.setItem('enquetesVotadas', JSON.stringify($scope.votadas));
                alert('Seu voto foi computado. Obrigado!');
                $scope.loadEnquetes();
            }).error(function(data) {
                alert("Erro ao votar! Por favor tente novamente mais tarde.");
            }).finally(function() {
                $('.loader').fadeOut(200);
            });
    };

    $scope.jaVotou = function() {
        alert('Você já votou nessa enquete');
    };

})

.controller('JuridicoFAQController', function($scope, $http) {
    $('.loader').show();

    $scope.openConvencao = function() {
        if (window.cordova)
            cordova.InAppBrowser.open('http://www.comerciarios.org.br/index.php/Convencoes-Coletivas-de-Trabalho ', '_system');
        else
            window.location = "http://www.comerciarios.org.br/index.php/Convencoes-Coletivas-de-Trabalho"
    }

    $http.post('http://aplicativo.comerciarios.org.br/app-data/api/juridico/faq.php')
        .success(function(data) {
            console.log(data);
            $scope.items = data;
        }).error(function(data) {
            alert("Erro! Por favor tente novamente mais tarde.");
        }).finally(function() {
            $('.loader').fadeOut(200);
        });
})

.controller('JuridicoFAQItemController', function($scope, $routeParams, $http, Utils) {
    $('.loader').show();

    var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';

    $http.post('http://aplicativo.comerciarios.org.br/app-data/api/juridico/faq-item.php', { categoria: $routeParams.param, registerToken: registerToken })
        .success(function(data) {
            $scope.items = data;
            console.log(data);
        }).error(function(data) {
            alert("Erro ao carregar galeria! Por favor tente novamente mais tarde.");
        }).finally(function() {
            $('.loader').fadeOut(200);
        });

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        Utils.collapsible();
    });

})

.controller('JuridicoDuvidasController', function($scope, $http, $httpParamSerializer) {
    $('#telefone').mask('(00) 0000-00009', { clearIfNotMatch: true });
    $('#getEmpByCnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });

    var empresaSerialize = "";
    var urlBase = "http://app.comerciarios.org.br:8095/denuncia/recebe_denuncia.php?";
    $scope.empresaPesquisada = [];
    $scope.empresaPesquisadaByCnpj = [];

    $scope.openConvencao = function() {
        if (window.cordova)
            cordova.InAppBrowser.open('http://www.comerciarios.org.br/index.php/Convencoes-Coletivas-de-Trabalho ', '_system');
        else
            window.location = "http://www.comerciarios.org.br/index.php/Convencoes-Coletivas-de-Trabalho"
    }

    //Btn de pesquisar Empresa
    $scope.pesquisarEmpresa = function(empresaNome, empresaCNPJ) {
        $('.loader').show();

        var urlBase = "http://mail.comerciarios.org.br:8095/api/api.php/?modulo=ajaxaction&",
            urlParam = undefined,
            urlTipo = undefined;

        if (empresaNome != undefined && empresaNome != null && empresaNome != "") {
            var urlParam = "getEmpAtivaByName=",
                urlTipo = empresaNome;
        } else if (empresaCNPJ != undefined && empresaCNPJ != null && empresaCNPJ != "") {
            var urlParam = "getEmpByCnpj=",
                urlTipo = empresaCNPJ;
        };

        //Change select de Empresas
        $scope.setHidden = function() {
            empresaSerialize = "&empend=" + $scope.empresaSelecionada.NM_eNDeReCO;
            empresaSerialize += "&empfantasia=" + $scope.empresaSelecionada.NM;
            empresaSerialize += "&empcnae=" + $scope.empresaSelecionada.CNAe_DeSCRICAO;
            empresaSerialize += "&empconv=" + $scope.empresaSelecionada.SGS_ENTI_CONV_NOME;
        };

        //Pesquisa na API
        $http.post(urlBase + urlParam + urlTipo)
            .then(function(data) {
                if (urlParam == "getEmpAtivaByName=") {
                    $scope.empresaPesquisada = data.data;
                    console.log($scope.empresaPesquisada);
                    if ($scope.empresaPesquisada.length <= 0) {
                        alert("Nenhuma empresa encontrada.");
                    };
                } else if (urlParam == "getEmpByCnpj=") {
                    var exp = angular.fromJson([data.data]);
                    console.log(exp);
                    if (exp[0].length != undefined) {
                        alert("Nenhuma empresa encontrada.");
                    } else {
                        $scope.empresaPesquisadaByCnpj = exp;
                    };
                    empresaSerialize = "&empend=" + $scope.empresaPesquisadaByCnpj[0].ENDERECOS;
                    empresaSerialize += "&empfantasia=" + $scope.empresaPesquisadaByCnpj[0].RAZAO_SOCIAL;
                    empresaSerialize += "&empcnae=" + $scope.empresaPesquisadaByCnpj[0].CNAE_DESCRICAO;
                    empresaSerialize += "&empconv=" + $scope.empresaPesquisadaByCnpj[0].CONVENCAO;
                };

            }, function() {
                alert('Algo deu errado. Tente novamente mais tarde!');
            })
            .finally(function() {
                $('.loader').fadeOut(200);
            });
    };

    //Envia Form para API
    $scope.enviaForm = function(form) {

        $('.loader').show();

        formOk = $httpParamSerializer(form);

        console.log("Form:" + formOk + empresaSerialize);

        $http.post("http://app.comerciarios.org.br:8095/duvida/recebe.php?" + formOk + empresaSerialize).then(function(data) {
            if (data.data.MSG_ERROR) {
                alert(data.data.MSG_ERROR);
            } else {
                alert(data.data.MSG);
            };
        }, function() {
            alert('Algo deu errado. Tente novamente mais tarde!');
        }).finally(function() {
            $('.loader').fadeOut(200);
        });
    };
})

.controller('NoticiasController', function($scope, $http, $sce, Utils) {
    $('.loader').show();
    $http.post('http://www.inventocom.com.br/comerciarios/app-data/index.php')
        .success(function(data) {
            console.log(data);
            $scope.noticias = data;
        }).error(function(data) {
            alert("Erro! Por favor tente novamente mais tarde.");
        }).finally(function() {
            $('.loader').fadeOut(200);
        });

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        Utils.collapsible();
    });

})

.controller('HistoriaController', function($scope, Utils) {
    $scope.itens = [{
            title: "Missão",
            txt: "A missão do Sindicato dos Comerciários de São Paulo é garantir os direitos trabalhistas e a melhoria das condições de vida do trabalhador comerciário, tanto na área sindical/trabalhista (política/legal), quanto na área social (saúde, lazer, cultura e habitação)."
        },
        {
            title: "Visão",
            txt: "O Sindicato dos Comerciários de São Paulo é uma entidade destinada a defender/proteger o direito dos trabalhadores, sendo reconhecida como representante, de fato e de direito, da categoria comerciária da base territorial, atuando fortemente na política sindical para o fortalecimento da categoria, para garantia de sucesso nas suas reivindicações e com reconhecimento nacional de sua força e compromisso social."
        },
        {
            title: "Valores",
            txt: "-Transparência e ética nas suas ações político-administrativas. <br> - Qualidade na prestação de serviços para os comerciários sindicalizados ou não. <br> - Capacitação do quadro de dirigentes e funcionários para consecução dos objetivos da entidade.<br> - Respeito ao ser humano e ao meio ambiente."
        }
    ];

    $scope.presidentes = [{
            ano: "2003",
            nome: "No mandato - Ricardo Patah"
        },
        {
            ano: "1989 / 2003",
            nome: "Rubens Romano"
        },
        {
            ano: "1970 / 1989",
            nome: "Sylvio de Vasconcellos"
        },
        {
            ano: "1962 / 1969",
            nome: "Mario Gessullo"
        },
        {
            ano: "1958 / 1962",
            nome: "Sylvio de Vasconcellos"
        },
        {
            ano: "1956 / 1958",
            nome: "Valentim Bonomo"
        },
        {
            ano: "1954 / 1956",
            nome: "Rui Barbosa"
        },
        {
            ano: "1952 / 1954",
            nome: "Paulo T. da Silva Braga"
        },
        {
            ano: "1950 / 1952",
            nome: "Amedeu Danilo Munhoz"
        },
        {
            ano: "1948 / 1950",
            nome: "Amedeu Danilo Munhoz"
        },
        {
            ano: "1946 / 1948",
            nome: "Alcides Dias Tavares"
        },
        {
            ano: "1944 / 1946",
            nome: "Alcides Dias Tavares"
        },
        {
            ano: "1942 / 1944",
            nome: "Sylvio de Oliveira Dorta"
        }
    ];

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        Utils.collapsible();
    });
})

.controller('DiretoriaController', function($scope, Utils) {

    $scope.itens = [
        { cargo: "Presidente", img: "img/diretores/presidente.jpg", nome: "Ricardo Patah" },
        { cargo: "Diretor Vice-Presidente", img: "img/diretores/gonzaga.jpg", nome: "José Gonzaga da Cruz" },
        { cargo: "Diretor Secretário Geral", img: "img/diretores/edson.jpg", nome: "Edson Ramos" },
        { cargo: "Diretor Tesoureiro/Financeiro", img: "img/diretores/duarte.jpg", nome: "Antonio Carlos Duarte" },
        { cargo: "Diretor do Departamento Jurídico", img: "img/diretores/marcos_afonso.jpg", nome: "Marcos Afonso de Oliveira" },
        { cargo: "Diretor de Educação, Formação Profissional e Esportes", img: "img/diretores/cabral.jpg", nome: "Antonio Evanildo Rabelo Cabral" },
        { cargo: "Diretor do Patrimônio", img: "img/diretores/neildo.jpg", nome: "Neildo Francisco de Assis" },
        { cargo: "Diretor de Relações Sindicais", img: "img/diretores/josimar.jpg", nome: "Josimar Andrade de Assis" },
        { cargo: "Diretora de Assistência Social e Previdência", img: "img/diretores/cleonice.jpg", nome: "Cleonice Caetano Souza" }
    ];

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        Utils.collapsible();
    });

})

.controller('PresidenciaController', function($scope) {})

.controller('ResponsabilidadeSocialController', function($scope, Utils) {

    $scope.itens = [{
            title: "Inclusão dos não brancos no mercado de trabalho",
            txt: "Fizemos, em 2003, o primeiro acordo no País para a inclusão de não brancos no comércio."
        },
        {
            title: "Inclusão da pessoa com deficiência no mercado de trabalho",
            txt: "Estamos empenhados na missão de participar e colaborar na promoção da qualidade de vida das pessoas com deficiência."
        },
        {
            title: "Mulher",
            txt: "Atuamos no controle e planejamento de ações, que objetivam apoiar projetos e políticas públicas de caráter preventivo, educativo e de capacitação que garantam os direitos da mulher e eliminem a violência e discriminação na sociedade e no mercado de trabalho."
        },
        {
            title: "LGBT (Lésbicas, Gays, Bissexuais e Transgêneros)",
            txt: "Apoiamos projetos de fortalecimento de instituições públicas e não-governamentais que atuam na promoção da cidadania homossexual e/ou no combate à homofobia."
        },
        {
            title: "Inclusão dos Moradores em Situação de Rua",
            txt: "Promovemos a inclusão dos moradores em situação de rua com ações afirmativas e de inclusão desses cidadãos no mercado de trabalho."
        },
        {
            title: "Ponte Brasilitália",
            txt: "É uma parceria entre o Sindicato dos Comerciários de São Paulo e o Sindicato dos Aposentados da Itália (UIL Pensionati). Oferece cidadania a mais de 250 crianças e adolescentes carentes, de 7 a 17 anos, da comunidade Vila Dalva, no Rio Pequeno."
        },
        {
            title: "Orientação ao Combate às Drogas",
            txt: "Com o slogan “DROGAS? TIRE ISSO DA SUA CABEÇA!”, o Comitê de Aconselhamento sobre álcool e drogas do Sindicato possui profissionais capacitados para orientar trabalhadores e familiares que têm problemas com álcool, tabaco e outras drogas a se livrarem do vício."
        },
        {
            title: "Trabalho Infantil e Jovem Aprendiz",
            txt: "Os temas que ocupam cada vez mais a agenda nacional e internacional exigem dos movimentos sindicais uma reflexão cuidadosa com relação às suas consequências e às estratégias sindicais para o seu combate. O papel do Sindicato é fortalecer esses movimentos contra o trabalho infantil, por meio de discussão e elaboração de manifesto/reinvindicação aos órgãos competentes."
        }
    ];

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        Utils.collapsible();
    });
})

.controller('SociosIndexController', function($scope, Utils) {

    $scope.itens = [
        { title: 'Empresas Parceiras', txt: '<a href="#faculdades"><h6>Faculdades</h6></a><br><a href="#escolasECursos"><h6>Escolas e cursos</h6></a><br><a href="#conveniosDiversos"><h6>Convênios diversos</h6></a>' },
        { title: 'Saúde', txt: '<a href="#ambulatorios"><h6>Ambulatório Médico e Odontológico</h6></a>' },
        { title: 'Lazer', txt: '<a href="#coloniaDeFerias"><h6>Colônia de Férias</h6></a><br><a href="#clubeDeCampo"><h6>Clude de Campo</h6></a>' }
    ];

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        Utils.collapsible();
    });

})

.controller('SociosRegulamentoController', function($scope, Utils) {

    $scope.itens = [
        { pergunta: '1) Como faço para me associar?', resposta: 'Para se associar é necessário estar trabalhando no comércio com carteira registrada. Caso queira mais informações <a href="http://comerciarios.org.br/wiki/index.php/FAQ#Onde_eu_me_encaixo.3F_Qual_a_minha_Conven.C3.A7.C3.A3o_Coletiva_de_Trabalho.3F"> Clique Aqui</a>' },
        { pergunta: '2) O que é preciso para ser sócio?', resposta: 'Para ser sócio é necessário ser maior de 18 anos, ou para menores de 18, apresentar autorização por escrito dos pais ou responsável.' },
        { pergunta: '3) Quais os documentos necessários?', resposta: 'Os documentos necessários são: <br> RG/ CPF/ carteira profissional/taxa admissional de R$ 20,00. <br><br> Caso seja casado, e tenha filhos menores de 18 anos, é necessário: <br> *Certidão de casamento e/ou declaração de união estável (no caso de amasiado) e cópia do RG do cônjuge. <br> *Certidão de nascimento ou rg dos filhos. <br> *No caso de enteados, só serão inclusos como dependentes caso seja apresentado comprovante da guarda legal dos mesmos.' },
        { pergunta: '4) Se eu quiser ser sócio tenho que ir até o Sindicato?', resposta: 'Existem três opções para se associar: <br> a) Pode ser feita pessoalmente nas subsedes ou sede (Rua Formosa, 99 ao lado do metrô Anhangabaú) <br> b) Pode ser feita pelo nosso site na opção <a href="#socios">Fique Sócio</a> <br> c) Pode ser passado o endereço da empresa/loja por contato telefônico, e um de nossos representantes entra em contato para combinar dia e horário para realizar a visita. <br> ' },
        { pergunta: '5) Qual é o valor da mensalidade?', resposta: 'A mensalidade é no valor de R$ 20,00 mensais. deverá ser pago enquanto for sócio.' },
        { pergunta: '6) Sou enfermeira, posso me associar?', resposta: 'Exemplos de algumas categorias que não podem se associar conosco: <br> *Proprietários/ Autônomos <br> *Imobiliárias <br> *Telemarketing <br> *Enfermeiros <br> *Cabelereiros <br> *Aposentados (exceto aposentados que estiverem ativos no comércio trabalhando com carteira registrada) <br> *Motorista ' },
        { pergunta: '7) Trabalho em Guarulhos posso me associar no sindicato dos comerciários de São Paulo.', resposta: 'COMERCIÁRIOS QUE EXCERCEREM FUNÇÃO FORA DO MUNICÍPIO DE SÃO PAULO, DEVE SE ASSOCIAR NO SINDICATO CORRESPONDENTE À SUA BASE. EX.: Funcionário do comércio em Guarulhos, deve se associar ao Sindicato dos Comerciários de Guarulhos.' }
    ];

    $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
        Utils.collapsible();
    });
})

.controller('FiqueSocioController', function($scope) {
    $('#cnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });
    $('#cepcom, #cep_resi').mask('00000-000', { clearIfNotMatch: true });
    $('#dtnascimento, .nascMask').mask('00/00/0000', { clearIfNotMatch: true });
    $('#cpf').mask('000.000.000-00', { clearIfNotMatch: true });
    $('#rg, .rgMask').mask('00.000.000-0', { clearIfNotMatch: true });
    $('#numcarteira, #seriecarteira').mask('00000', { clearIfNotMatch: true });
    $('#telresidencial, #telcomercial, #tel_recado').mask('(00) 0000-0000', { clearIfNotMatch: true });
    $('#celular').mask('(00)0000-00009', { clearIfNotMatch: true });

    $scope.scrollTop = function() {
        alert('Preencha os dados dos seus Dependentes:');
    };

})

.controller('subSedesController', function($scope, $window) {
    $scope.goBack = function() {
        $window.history.back();
    };
})

.controller('subSedeDetalheController', function($scope, $routeParams, $location) {
    $scope.subSede = $routeParams.param;

    if ($scope.subSede == 1) {

        $scope.title = "Subsede Pinheiros";
        $scope.endereco = "Rua Deputado Lacerda Franco, 125 CEP 05418-000 - São Paulo/SP";
        $scope.telefone = "11 2142-3300";
        $scope.email = "pinheiros@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+Deputado+Lacerda+Franco,+125&amp;aq=&amp;sll=-23.53353,-46.563258&amp;sspn=0.008036,0.010321&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Dep.+Lacerda+Franco,+125+-+Pinheiros,+S%C3%A3o+Paulo,+05418-000&amp;t=m&amp;ll=-23.563987,-46.690178&amp;spn=0.012116,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';

    } else if ($scope.subSede == 2) {

        $scope.title = "Subsede Tatuapé";
        $scope.endereco = "Rua Dr. Raul da Rocha Medeiros, 72 CEP 03071-100 - São Paulo/SPa";
        $scope.telefone = "11 3466-9393";
        $scope.email = "tatuape@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+Dr.+Raul+da+Rocha+Medeiros,+72&amp;aq=&amp;sll=-23.518338,-46.703364&amp;sspn=0.008037,0.010321&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Dr.+Raul+da+Rocha+Medeiros,+72+-+Tatuape,+S%C3%A3o+Paulo,+03071-100&amp;t=m&amp;ll=-23.533537,-46.563234&amp;spn=0.012119,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';

    } else if ($scope.subSede == 3) {

        $scope.title = "Subsede Lapa";
        $scope.endereco = "Rua 12 de outubro, 385 - 4º andar - cjs 41/42 e 6º andar cj 62 - CEP 05073-001 São Paulo/SP";
        $scope.telefone = "11 2131-9900/9901";
        $scope.email = "lapa@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+12+de+outubro,+38&amp;aq=&amp;sll=-23.649321,-46.706386&amp;sspn=0.008029,0.010321&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Doze+de+Outubro,+38+-+Lapa,+S%C3%A3o+Paulo,+05073-000&amp;t=m&amp;ll=-23.518349,-46.703396&amp;spn=0.01212,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';

    } else if ($scope.subSede == 4) {

        $scope.title = "Subsede Santo Amaro";
        $scope.endereco = "Rua Coronel Luís Barroso, 102/106 CEP 04750-030 - São Paulo/SP";
        $scope.telefone = "11 2162-1700/1701";
        $scope.email = "santoamaro@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+Coronel+Lu%C3%ADs+Barroso,+102&amp;aq=&amp;sll=-23.502994,-46.626486&amp;sspn=0.008038,0.010321&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Cel.+Lu%C3%ADs+Barroso,+102+-+Santo+Amaro,+S%C3%A3o+Paulo,+04750-030&amp;t=m&amp;ll=-23.64932,-46.7064&amp;spn=0.012108,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';

    } else if ($scope.subSede == 5) {

        $scope.title = "Subsede Santana";
        $scope.endereco = "Rua Voluntários da Pátria , 1961 - 4º andar - cjs. 401/402 - CEP 02010-600 São Paulo/SP";
        $scope.telefone = "11 2121-9250/9254";
        $scope.email = "santana@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+Volunt%C3%A1rios+da+P%C3%A1tria,+1961&amp;aq=&amp;sll=-23.502994,-46.626486&amp;sspn=0.008038,0.010321&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Volunt%C3%A1rios+da+P%C3%A1tria,+1961+-+Santana,+S%C3%A3o+Paulo,+02011-400&amp;t=m&amp;ll=-23.503001,-46.626492&amp;spn=0.012121,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';

    } else if ($scope.subSede == 6) {

        $scope.title = "Subsede São Miguel";
        $scope.endereco = "Rua Arlindo Colaço, 162 CEP 08010-010 São Paulo/SP";
        $scope.telefone = "11 3466-9600";
        $scope.email = "saomiguel@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+Arlindo+Cola%C3%A7o,+162&amp;aq=&amp;sll=-23.52913,-46.639945&amp;sspn=0.008037,0.010321&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Arlindo+Cola%C3%A7o,+162+-+S%C3%A3o+Miguel,+S%C3%A3o+Paulo,+08010-010&amp;t=m&amp;ll=-23.492532,-46.442728&amp;spn=0.012122,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';

    } /*else if ($scope.subSede == 7) {

        $scope.title = "Subsede Bom Retiro";
        $scope.endereco = "Rua José Paulino, 586, 5º andar (salas 53 e 54). CEP 01120-000 - São Paulo/SP";
        $scope.telefone = "11 2504-3500";
        $scope.email = "bomretiro@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+Jos%C3%A9+Paulino,+586&amp;aq=&amp;sll=-23.541278,-46.613649&amp;sspn=0.008036,0.010321&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Jos%C3%A9+Paulino,+586+-+Bom+Retiro,+S%C3%A3o+Paulo,+01120-000&amp;t=m&amp;ll=-23.52913,-46.639967&amp;spn=0.012119,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';

    } */
    else if ($scope.subSede == 7) {

        $scope.title = "Subsede Brás";
        $scope.endereco = "Rua Brigadeiro Machado, 33 – 1º andar CEP 03050-050 - São Paulo/SP";
        $scope.telefone = "11 2144-9671";
        $scope.email = "bras@comerciarios.org.br";
        $scope.map = '<iframe src="http://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt&amp;geocode=&amp;q=Rua+Brigadeiro+Machado,+33&amp;aq=&amp;sll=-22.546052,-48.635514&amp;sspn=8.608309,10.601807&amp;ie=UTF8&amp;hq=&amp;hnear=R.+Brg.+Machado,+33+-+Br%C3%A1s,+S%C3%A3o+Paulo,+03050-050&amp;t=m&amp;ll=-23.541406,-46.613617&amp;spn=0.012118,0.024462&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="100%" height="200"></iframe>';
    } else {
        $location.path('/home');
    }
})

.controller('sedeController', function($scope, $window) {
    $scope.goBack = function() {
        $window.history.back();
    };
})

.controller('ambulatoriosController', function($scope, Utils) {
    Utils.collapsible();
})

.controller('parceirosIndexController', function($scope, $http, Utils) {
    Utils.collapsible();
})

.controller('conveniosDiversosController', function($scope, $http, Utils, Parceiros) {
    $('.loader').show();
    $('.percent').mask('00');

    $scope.ConveniosDiversos = [];

    $scope.getConveniosDiversos = function(filter, atualizar) {
        if (filter != undefined) {
            var url = 'http://www.comerciarios.org.br/index.php/parcerias_busca?out=json&filtro%5btipo%5d%5b%5d=Convenios%20Diversos' + filter;
        } else {
            var url = 'http://www.comerciarios.org.br/index.php/parcerias_busca?out=json&filtro%5btipo%5d%5b%5d=Convenios%20Diversos';
        };

        $http.post(url).then(function(response) {
                $scope.dados = response.data;
                if (atualizar) {
                    $scope.atualizar($scope.dados, true);
                } else {
                    $scope.atualizar($scope.dados, false);
                }

            }, function() {
                alert('Algo deu errado. Tente novamente mais tarde!')
            })
            .finally(function(response) {
                $('.loader').hide();
            });
    };

    $scope.atualizar = function(reset) {
        if (!reset) {
            $scope.ConveniosDiversos = $scope.ConveniosDiversos.concat($scope.dados.splice(0, 5));
        } else {
            $scope.ConveniosDiversos = $scope.dados.splice(0, 5);
        };
        $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
            Utils.collapsible();
        });
    };

    $scope.filtrarParceiros = function(formFiltrar) {
        $scope.getConveniosDiversos(Parceiros.filtrar(formFiltrar), true);
    };

    $scope.getConveniosDiversos();
})

.controller('escolasECursosController', function($scope, $http, Utils, Parceiros) {

    $('.loader').show();
    $('.percent').mask('00');

    $scope.ConveniosDiversos = [];

    $scope.getConveniosDiversos = function(filter, atualizar) {
        if (filter != undefined) {
            var url = 'http://www.comerciarios.org.br/index.php/parcerias_busca?out=json&filtro%5btipo%5d%5b%5d=Escolas%20e%20Cursos' + filter;
        } else {
            var url = 'http://www.comerciarios.org.br/index.php/parcerias_busca?out=json&filtro%5btipo%5d%5b%5d=Escolas%20e%20Cursos';
        };

        $http.post(url).then(function(response) {
                $scope.dados = response.data;
                if (atualizar) {
                    $scope.atualizar($scope.dados, true);
                } else {
                    $scope.atualizar($scope.dados, false);
                }

            }, function() {
                alert('Algo deu errado. Tente novamente mais tarde!')
            })
            .finally(function(response) {
                $('.loader').hide();
            });
    };

    $scope.atualizar = function(reset) {
        if (!reset) {
            $scope.escolasCursos = $scope.escolasCursos.concat($scope.dados.splice(0, 5));
        } else {
            $scope.escolasCursos = $scope.dados.splice(0, 5);
        };
        $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
            Utils.collapsible();
        });
    };

    $scope.filtrarParceiros = function(formFiltrar) {
        $scope.getConveniosDiversos(Parceiros.filtrar(formFiltrar), true);
    };

    $scope.getConveniosDiversos();

})

.controller('faculdadesController', function($scope, $http, Utils, Parceiros) {

    $('.loader').show();
    $('.percent').mask('00');

    $scope.faculdades = [];

    $scope.getFaculdades = function(filter, atualizar) {
        console.log('filter ', filter);
        if (filter != undefined) {
            var url = 'http://www.comerciarios.org.br/index.php/parcerias_busca?out=json&filtro%5btipo%5d%5b%5d=Faculdades%20e%20Universidades' + filter;
        } else {
            var url = 'http://www.comerciarios.org.br/index.php/parcerias_busca?out=json&filtro%5btipo%5d%5b%5d=Faculdades%20e%20Universidades';
        };

        $http.post(url).then(function(response) {
                $scope.dados = response.data;
                if (atualizar) {
                    $scope.atualizar($scope.dados, true);
                } else {
                    $scope.atualizar($scope.dados, false);
                }

            }, function() {
                alert('Algo deu errado. Tente novamente mais tarde!')
            })
            .finally(function(response) {
                $('.loader').hide();
            });
    };

    $scope.atualizar = function(reset) {
        if (!reset) {
            $scope.faculdades = $scope.faculdades.concat($scope.dados.splice(0, 5));
        } else {
            $scope.faculdades = $scope.dados.splice(0, 5);
        };
        $scope.$on('ngRepeatFinished', function(ngRepeatFinishedEvent) {
            Utils.collapsible();
        });
    };

    $scope.filtrarParceiros = function(formFiltrar) {
        $scope.getFaculdades(Parceiros.filtrar(formFiltrar), true);
    };

    $scope.getFaculdades();

})

.controller('coloniaDeFeriasController', function($scope, $http) {
    var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';

    /* Infos de descrição' */
    var lazerData = { categoria: 'coloniaDeFerias', registerToken: registerToken }
    $http.post('http://aplicativo.comerciarios.org.br/app-data/api/lazer.php', lazerData)
        .success(function(data) {
            data = data[0];
            $scope.titulo = data.titulo;
            $scope.description = data.description;
            $scope.telefone = data.telefone[0] + data.telefone[1] + ' ' + data.telefone.substr(2, 4) + '-' + data.telefone.substr(6, 10);
            $scope.localizacao = data.localizacao;
            $scope.gmaps_embed = data.gmaps_embed.substr(data.gmaps_embed.indexOf('src="') + 5, data.gmaps_embed.indexOf('width="') - 15);
            $scope.gmaps_link = data.gmaps_link;
        }).error(function(data) {
            alert("Erro ao carregar conteúdo! Por favor tente novamente mais tarde.");
        });

    /* Classificação */
    $scope.fetchRating = function() {
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/lazer/rating.php', { categoria: 'coloniaDeFerias', registerToken: registerToken })
            .success(function(data) {
                $scope.getRating = function() {
                    var rating = [];
                    for (var i = 0; i < data; i++) {
                        rating.push(i)
                    }
                    return rating;
                }
            }).error(function(data) {
                $scope.ratedError = true;
                alert("Erro ao carregar classificação! Por favor tente novamente.");
            });
    }

    $scope.fetchRating();

    $scope.rate = function(grade) {
        $('.loader').show();
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/lazer/setRating.php', { categoria: 'coloniaDeFerias', registerToken: registerToken, nota: grade })
            .success(function(data) {
                alert('Classificação ' + grade + ' computada com sucesso. Obrigado!');
                $scope.rated = grade;
                $scope.fetchRating();
            }).error(function(data) {
                alert("Erro ao salvar classificação! Por favor tente novamente.");
            }).finally(function() {
                $('.loader').fadeOut(200);
            });
    };

})

.controller('coloniaDeFeriasPrecosController', function($scope, $http) {
    var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';
    $('.loader').show();

    $http.post('http://www.inventocom.com.br/comerciarios/app-data/api/coloniadeferias_getAll.php')
        .success(function(data) {
            /* Tabela */
            $scope.resultsOne = data.resultsOne;
            $scope.resultsTwo = data.resultsTwo;
            $scope.resultsThree = data.resultsThree;
            $scope.resultsFour = data.resultsFour;
            $scope.resultsFive = data.resultsFive;
            $scope.resultsSix = data.resultsSix;
        }).error(function(data) {
            alert("Erro ao carregar tabela de preços! Por favor tente novamente mais tarde.");
        }).finally(function() {
            $('.loader').fadeOut(200);
        });
})

.controller('coloniaDeFeriasGaleriaController', function($scope, $http) {
    var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';
    $('.loader').show();

    /* Busca fotos da galeria */
    $http.post('http://aplicativo.comerciarios.org.br/app-data/api/img/lazer/getGallery.php', { categoria: 'coloniaDeFerias', registerToken: registerToken })
        .success(function(data) {
            $scope.gallery = data;
        }).error(function(data) {
            alert("Erro ao carregar galeria! Por favor tente novamente mais tarde.");
        }).finally(function() {
            $('.loader').fadeOut(200);
        });

    jQuery('.swipebox').swipebox();
})

.controller('clubeDeCampoController', function($scope, $http) {
    var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';

    var lazerData = { categoria: 'clubeDeCampo', registerToken: registerToken }
    $http.post('http://aplicativo.comerciarios.org.br/app-data/api/lazer.php', lazerData)
        .success(function(data) {
            data = data[0];
            $scope.titulo = data.titulo;
            $scope.description = data.description;
            $scope.telefone = data.telefone[0] + data.telefone[1] + ' ' + data.telefone.substr(2, 4) + '-' + data.telefone.substr(6, 10);
            $scope.localizacao = data.localizacao;
            $scope.gmaps_embed = data.gmaps_embed.substr(data.gmaps_embed.indexOf('src="') + 5, data.gmaps_embed.indexOf('width="') - 15);
            $scope.gmaps_link = data.gmaps_link;
        }).error(function(data) {
            alert("Erro! Por favor tente novamente mais tarde.");
        });

    /* Classificação */
    $scope.fetchRating = function() {
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/lazer/rating.php', { categoria: 'clubeDeCampo', registerToken: registerToken })
            .success(function(data) {
                $scope.getRating = function() {
                    var rating = [];
                    for (var i = 0; i < data; i++) {
                        rating.push(i)
                    }
                    return rating;
                }
            }).error(function(data) {
                $scope.ratedError = true;
                alert("Erro ao carregar classificação! Por favor tente novamente.");
            });
    }

    $scope.fetchRating();

    $scope.rate = function(grade) {
        $('.loader').show();
        $http.post('http://aplicativo.comerciarios.org.br/app-data/api/lazer/setRating.php', { categoria: 'clubeDeCampo', registerToken: registerToken, nota: grade })
            .success(function(data) {
                alert('Classificação ' + grade + ' computada com sucesso. Obrigado!');
                $scope.rated = grade;
                $scope.fetchRating();
            }).error(function(data) {
                alert("Erro ao salvar classificação! Por favor tente novamente.");
            }).finally(function() {
                $('.loader').fadeOut(200);
            });
    };

})

.controller('clubeDeCampoGaleriaController', function($scope, $http) {
    var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';

    /* Busca fotos da galeria */
    $http.post('http://aplicativo.comerciarios.org.br/app-data/api/img/lazer/getGallery.php', { categoria: 'clubeDeCampo', registerToken: registerToken })
        .success(function(data) {
            $scope.gallery = data;
        }).error(function(data) {
            alert("Erro ao carregar galeria! Por favor tente novamente mais tarde.");
        });

    jQuery('.swipebox').swipebox();

})

.controller('clubeDeCampoPrecosController', function($scope, $http) {
    var registerToken = 'b93136f6223bb2d0fd8ba1a7ad153fec';

    $http.post('http://www.inventocom.com.br/comerciarios/app-data/api/clubedecampo_getAll.php')
        .success(function(data) {
            $scope.resultsOne = data.resultsOne;
            $scope.resultsTwo = data.resultsTwo;
            $scope.resultsThree = data.resultsThree;
        }).error(function(data) {
            alert("Erro! Por favor tente novamente mais tarde.");
        });
})

.controller('faleConoscoController', function($scope, $http, $httpParamSerializer) {
    $('#telefone').mask('(00) 0000-00009', { clearIfNotMatch: true });
    $('#getEmpByCnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });

    var empresaSerialize = "";
    var urlBase = "http://app.comerciarios.org.br:8095/denuncia/recebe_denuncia.php?";
    $scope.empresaPesquisada = [];
    $scope.empresaPesquisadaByCnpj = [];

    //Btn de pesquisar Empresa
    $scope.pesquisarEmpresa = function(empresaNome, empresaCNPJ) {
        $('.loader').show();

        var urlBase = "http://mail.comerciarios.org.br:8095/api/api.php/?modulo=ajaxaction&",
            urlParam = undefined,
            urlTipo = undefined;

        if (empresaNome != undefined && empresaNome != null && empresaNome != "") {
            var urlParam = "getEmpAtivaByName=",
                urlTipo = empresaNome;
        } else if (empresaCNPJ != undefined && empresaCNPJ != null && empresaCNPJ != "") {
            var urlParam = "getEmpByCnpj=",
                urlTipo = empresaCNPJ;
        };

        //Change select de Empresas
        $scope.setHidden = function() {
            empresaSerialize = "&empend=" + $scope.empresaSelecionada.NM_eNDeReCO;
            empresaSerialize += "&empfantasia=" + $scope.empresaSelecionada.NM;
            empresaSerialize += "&empcnae=" + $scope.empresaSelecionada.CNAe_DeSCRICAO;
            empresaSerialize += "&empconv=" + $scope.empresaSelecionada.SGS_ENTI_CONV_NOME;
        };

        //Pesquisa na API
        $http.post(urlBase + urlParam + urlTipo)
            .then(function(data) {
                if (urlParam == "getEmpAtivaByName=") {
                    $scope.empresaPesquisada = data.data;
                    console.log($scope.empresaPesquisada);
                    if ($scope.empresaPesquisada.length <= 0) {
                        alert("Nenhuma empresa encontrada.");
                    };
                } else if (urlParam == "getEmpByCnpj=") {
                    var exp = angular.fromJson([data.data]);
                    console.log(exp);
                    if (exp[0].length != undefined) {
                        alert("Nenhuma empresa encontrada.");
                    } else {
                        $scope.empresaPesquisadaByCnpj = exp;
                    };
                    empresaSerialize = "&empend=" + $scope.empresaPesquisadaByCnpj[0].ENDERECOS;
                    empresaSerialize += "&empfantasia=" + $scope.empresaPesquisadaByCnpj[0].RAZAO_SOCIAL;
                    empresaSerialize += "&empcnae=" + $scope.empresaPesquisadaByCnpj[0].CNAE_DESCRICAO;
                    empresaSerialize += "&empconv=" + $scope.empresaPesquisadaByCnpj[0].CONVENCAO;
                };

            }, function() {
                alert('Algo deu errado. Tente novamente mais tarde!');
            })
            .finally(function() {
                $('.loader').fadeOut(200);
            });
    };

    //Envia Form para API
    $scope.enviaForm = function(form) {

        $('.loader').show();

        formOk = $httpParamSerializer(form);

        console.log("Form:" + formOk + empresaSerialize);

        $http.post("http://app.comerciarios.org.br:8095/duvida/recebe.php?" + formOk + empresaSerialize).then(function(data) {
            if (data.data.MSG_ERROR) {
                alert(data.data.MSG_ERROR);
            } else {
                alert(data.data.MSG);
            };
        }, function() {
            alert('Algo deu errado. Tente novamente mais tarde!');
        }).finally(function() {
            $('.loader').fadeOut(200);
        });
    };
})

.controller('falePresidenteController', function($scope, $http) {
    $scope.pessoa_fisica = 'F';
    $('#telefone').mask('(00) 0000-00009', { clearIfNotMatch: true });
    $('#cpf').mask('000.000.000-00', { clearIfNotMatch: true });
    $('#cnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });

    $scope.enviaForm = function(form) {
        $http.post('http://comerciarios.org.br/index.php/fale_com_o_presidente?enviar=1&' + $.param(form))
            .then(function(data) {
                alert(data.data.msg);
            }, function() {
                alert('Algo deu errado. Tente novamente mais tarde!');
            });
    };

})

.controller('denunciaController', function($scope, $http, $httpParamSerializer) {
    $('.telefone').mask('(00) 0000-00009', { clearIfNotMatch: true });
    $('#getEndEmpByCnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });

    var empresaSerialize = "";
    var urlBase = "http://app.comerciarios.org.br:8095/denuncia/recebe_denuncia.php?";
    $scope.empresaPesquisada = [];
    $scope.empresaPesquisadaByCnpj = [];

    //Btn de pesquisar Empresa
    $scope.pesquisarEmpresa = function(empresaNome, empresaCNPJ) {
        $('.loader').show();

        var urlBase = "http://mail.comerciarios.org.br:8095/api/api.php/?modulo=ajaxaction&",
            urlParam = undefined,
            urlTipo = undefined;

        if (empresaNome != undefined && empresaNome != null && empresaNome != "") {
            var urlParam = "getEmpAtivaByName=",
                urlTipo = empresaNome;
        } else if (empresaCNPJ != undefined && empresaCNPJ != null && empresaCNPJ != "") {
            var urlParam = "getEmpByCnpj=",
                urlTipo = empresaCNPJ;
        };

        //Change select de Empresas
        $scope.setHidden = function() {
            empresaSerialize = "&EmpEnd=" + $scope.empresaSelecionada.NM_ENDERECO;
            empresaSerialize += "&EmpFantasia=" + $scope.empresaSelecionada.NM;
            empresaSerialize += "&EmpCnae=" + $scope.empresaSelecionada.CNAE_DESCRICAO;
            empresaSerialize += "&EmpConv=" + $scope.empresaSelecionada.SGS_ENTI_CONV_NOME;
        };

        //Pesquisa na API
        $http.post(urlBase + urlParam + urlTipo)
            .then(function(data) {
                if (urlParam == "getEmpAtivaByName=") {
                    $scope.empresaPesquisada = data.data;
                    console.log($scope.empresaPesquisada);
                    if ($scope.empresaPesquisada.length <= 0) {
                        alert("Nenhuma empresa encontrada.");
                    };
                } else if (urlParam == "getEmpByCnpj=") {
                    var exp = angular.fromJson([data.data]);
                    console.log(exp);
                    if (exp[0].length != undefined) {
                        alert("Nenhuma empresa encontrada.");
                    } else {
                        $scope.empresaPesquisadaByCnpj = exp;
                    };
                    empresaSerialize = "&EmpEnd=" + $scope.empresaPesquisadaByCnpj[0].ENDERECOS;
                    empresaSerialize += "&EmpFantasia=" + $scope.empresaPesquisadaByCnpj[0].RAZAO_SOCIAL;
                    empresaSerialize += "&EmpCnae=" + $scope.empresaPesquisadaByCnpj[0].CNAE_DESCRICAO;
                    empresaSerialize += "&EmpConv=" + $scope.empresaPesquisadaByCnpj[0].CONVENCAO;
                };

            }, function() {
                alert('Algo deu errado. Tente novamente mais tarde!');
            })
            .finally(function() {
                $('.loader').fadeOut(200);
            });
    };

    //Envia Form para API
    $scope.enviaForm = function(form) {

        $('.loader').show();

        formOk = $httpParamSerializer(form).replace("CA", "[").replace("CF", "]");

        console.log("Form:" + formOk + empresaSerialize);

        $http.post(urlBase + formOk + empresaSerialize).then(function(data) {
            if (data.data.MSG_ERROR) {
                alert(data.data.MSG_ERROR);
            } else {
                alert(data.data.MSG);
            };
        }, function() {
            alert('Algo deu errado. Tente novamente mais tarde!');
        }).finally(function() {
            $('.loader').fadeOut(200);
        });
    };
})

.controller('missRegulamentoController', function() {})

.controller('missInscricaoController', function() {
    $('.nascimento_valor').mask('00/00/0000', { clearIfNotMatch: true });
    $('.telefone').mask('(00) 0000-0000', { clearIfNotMatch: true });
    $('.celular').mask('(00)0000-00009', { clearIfNotMatch: true });
    $('#cnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });
})

.controller('vagaSocialController', function($scope) {
    $scope.cadastrarCv = function() {
        alert('SERVIÇO EM FASE DE IMPLANTAÇÃO. EM BREVE ESTARÁ DISPONÍVEL');
    };
})

.controller('cadastrarCurriculoController', function() {})

.controller('curriculoPCDController', function() {});