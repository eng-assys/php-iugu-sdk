<?php

namespace Iugu;

/**
 * Class Subscription
 *
 * @package Iugu
 */
class Subscription implements \JsonSerializable
{

    /** @var string
     * Identificador da Assinatura.
     */
    private $id;

    /** @var string
     * Identificador do Plano. Só é enviado para assinaturas que não são credits_based.
     */
    private $plan_identifier;

    /** @var string
     * ID do Cliente.
     */
    private $customer_id;

    /** @var string
     * Data de Expiração "DD-MM-AAAA". 
     * (Data da primeira cobrança, as próximas datas de cobrança dependem do "intervalo" do plano vinculado).
     */
    private $expires_at;

    /** @var bool
     * Apenas Cria a Assinatura se a Cobrança for bem sucedida.
     * Isso só funciona caso o cliente já tenha uma forma de pagamento padrão cadastrada.
     * Não enviar "expires_at".
     */
    private $only_on_charge_success;

    /** @var bool
     * Desabilita o envio de emails notificando o vencimento de uma
     * fatura em assinaturas que podem ser pagas com boleto bancário.
     */
    private $ignore_due_email;

    /** @var string
     * Método de pagamento que será disponibilizado para as Faturas desta Assinatura:
     * (all, credit_card ou bank_slip).
     * Obs: Dependendo do valor, este atributo será herdado, 
     * pois a prioridade é herdar o valor atribuído ao Plano desta Assinatura;
     * caso este esteja atribuído o valor ‘all’, o sistema considerará o payable_with da Assinatura;
     * se não, o sistema considerará o payable_with do Plano.
     */
    private $payable_with;

    /** @var bool
     * É uma assinatura baseada em créditos?
     */
    private $credits_based;

    /** @var int
     * Preço em centavos da recarga para assinaturas baseadas em crédito.
     */
    private $price_cents;

    /** @var int
     * Quantidade de créditos adicionados a cada ciclo, só enviado para assinaturas credits_based.
     */
    private $credits_cycle;

    /** @var int
     * Quantidade de créditos que ativa o ciclo,
     * por ex: Efetuar cobrança cada vez que a assinatura tenha apenas 1 crédito sobrando.
     * Esse 1 crédito é o credits_min.
     */
    private $credits_min;

    /** @var array
     * Adiciona itens de cobrança a mais na assinatura do cliente. "price_cents" valor mínimo 100.
     */
    private $subitems;

    /** @var array
     * Variáveis personalizadas.
     */
    private $custom_variables;

    /** 
     * @var bool
     */
    private $suspended;

    /** 
     * @var string
     */
    private $currency;

    /** 
     * @var array
     */
    private $features;

    /** 
     * @var string
     */
    private $created_at;

    /** 
     * @var string
     */
    private $updated_at;

    /** 
     * @var string
     */
    private $customer_name;

    /** 
     * @var string
     */
    private $customer_email;

    /** 
     * @var string
     */
    private $cycled_at;

    /** 
     * @var string
     */
    private $plan_name;

    /** 
     * @var string
     */
    private $customer_ref;

    /** 
     * @var string
     */
    private $plan_ref;

    /** 
     * @var bool
     */
    private $active;

    /** 
     * @var bool
     */
    private $in_trial;

    /** 
     * @var int
     */
    private $credits;

    /** 
     * @var array
     */
    private $recent_invoices;

    /** 
     * @var array
     */
    private $logs;


    /**
     * @param $json
     *
     * @return Subscription
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);
        $payer = new Subscription();
        $payer->populate($object);
        return $payer;
    }



    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), function ($var) {
            return $var !== null;
        });
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        foreach (get_object_vars($this) as $key => $value) {
            $this->{$key} = $data->{$key} ?? null;
            if (isset($data->{$key}) && $data->{$key} === false) {
                $this->{$key} = false;
            }
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlanIdentifier()
    {
        return $this->plan_identifier;
    }

    /**
     * @param $plan_identifier
     *
     * @return $this
     */
    public function setPlanIdentifier($plan_identifier)
    {
        $this->plan_identifier = $plan_identifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param $customer_id
     *
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    /**
     * @param $expires_at
     *
     * @return $this
     */
    public function setExpiresAt($expires_at)
    {
        $this->expires_at = $expires_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getOnlyOnChargeSuccess()
    {
        return $this->only_on_charge_success;
    }

    /**
     * @param $only_on_charge_success
     *
     * @return $this
     */
    public function setOnlyOnChargeSuccess($only_on_charge_success)
    {
        $this->only_on_charge_success = $only_on_charge_success;
        return $this;
    }

    /**
     * @return string
     */
    public function getIgnoreDueEmail()
    {
        return $this->ignore_due_email;
    }

    /**
     * @param $ignore_due_email
     *
     * @return $this
     */
    public function setIgnoreDueEmail($ignore_due_email)
    {
        $this->ignore_due_email = $ignore_due_email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPayableWith()
    {
        return $this->payable_with;
    }

    /**
     * @param $payable_with
     *
     * @return $this
     */
    public function setPayableWith($payable_with)
    {
        $this->payable_with = $payable_with;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditsBased()
    {
        return $this->credits_based;
    }

    /**
     * @param $credits_based
     *
     * @return $this
     */
    public function setCreditsBased($credits_based)
    {
        $this->credits_based = $credits_based;
        return $this;
    }

    /**
     * @return string
     */
    public function getPriceCents()
    {
        return $this->price_cents;
    }

    /**
     * @param $price_cents
     *
     * @return $this
     */
    public function setPriceCents($price_cents)
    {
        $this->price_cents = $price_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditsCycle()
    {
        return $this->credits_cycle;
    }

    /**
     * @param $credits_cycle
     *
     * @return $this
     */
    public function setCreditsCycle($credits_cycle)
    {
        $this->credits_cycle = $credits_cycle;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreditsMin()
    {
        return $this->credits_min;
    }

    /**
     * @param $credits_min
     *
     * @return $this
     */
    public function setCreditsMin($credits_min)
    {
        $this->credits_min = $credits_min;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubitems()
    {
        return $this->subitems;
    }

    /**
     * @param $subitems
     *
     * @return $this
     */
    public function setSubitems($subitems)
    {
        $this->subitems = $subitems;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomVariables()
    {
        return $this->custom_variables;
    }

    /**
     * @param $custom_variables
     *
     * @return $this
     */
    public function setCustomVariables($custom_variables)
    {
        $this->custom_variables = $custom_variables;
        return $this;
    }
}
