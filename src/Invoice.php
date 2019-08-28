<?php

namespace Iugu;

/**
 * Class Invoice
 *
 * @package Iugu
 */
class Invoice implements \JsonSerializable
{

    /** @var string
     * Identificador da fatura.
     */
    private $id;

    /** @var string
     * Vencimento da fatura.
     */
    private $due_date;

    /** @var string
     * Moeda em que foi gerada a fatura.
     */
    private $currency;

    /** @var integer|null
     * Desconto em centavos.
     */
    private $discount_cents;

    /** @var string
     * 	Email da fatura.
     */
    private $email;

    /** @var integer
     * Valor em centavos dos items.
     */
    private $items_total_cents;

    /** @var string|null
     * URL chamada para todas as notificações de fatura.
     */
    private $notification_url;

    /** @var string|null
     * Cliente é redirecionado para essa URL após efetuar o pagamento da fatura pela página de fatura da Iugu.
     */
    private $return_url;

    /** @var string
     * Status da fatura. 
     * 
     * Valores possíveis:
     * pending
     * paid
     * canceled
     * draft
     * partially_paid
     * refunded
     * expired
     * in_protest
     * chargeback
     * in_analysis
     * 
     * @see https://support.iugu.com/hc/pt-br/articles/213163706-Lista-de-status-de-fatura-e-seus-significados
     */
    private $status;

    /** @var int|null
     * Valor de taxas em centavos.
     */
    private $tax_cents;

    /** @var string
     * Data da última atualização.
     */
    private $updated_at;

    /** @var int
     * Valor total da fatura em centavos.
     */
    private $total_cents;

    /** @var string
     * Data em que o pagamento da fatura foi efetuado.
     */
    private $paid_at;

    /** @var int|null
     * Valor da comissão da fatura em centavos.
     */
    private $commission_cents;

    /** @var string
     * Identificador público da fatura.
     */
    private $secure_id;

    /** @var string
     * URL da fatura.
     */
    private $secure_url;

    /** @var string|null
     * ID do cliente.
     */
    private $customer_id;

    /** @var string|null
     * ID do usuário.
     */
    private $user_id;

    /** @var string
     * Valor total da fatura formatado.
     */
    private $total;

    /** @var string
     * Valor total das taxas da fatura formatado.
     */
    private $taxes_paid;

    /** @var string
     * Valor total da comissão da fatura formatado.
     */
    private $commission;

    /** @var string|null
     * Juros por atraso.
     */
    private $interest;

    /** @var string|null
     * Desconto.
     */
    private $discount;

    /** @var bool|null
     * Indica se a fatura é reembolsável.
     */
    private $refundable;

    /** @var string|null
     * Parcela da fatura.
     */
    private $installments;

    /** @var object
     * Dados do boleto.
     */
    private $bank_slip;

    /** @var array
     * Items da fatura.
     */
    private $items;

    /** @var array
     * Variáveis customizadas da fatura.
     */
    private $custom_variables;

    /** @var array
     * Logs da fatura.
     */
    private $logs;

    /** @var string
     * Emails para cópia separados por vírgula
     */
    private $cc_email;

    /** @var bool
     * Se true garante que a data de vencimento seja apenas em dias de semana, e não em sábados ou domingos.
     */
    private $ensure_workday_due_date;

    /** @var string
     * Cliente é redirecionado para essa URL se a Fatura que estiver acessando estiver expirada.
     */
    private $expired_url;

    /** @var bool
     * Booleano para Habilitar ou Desabilitar multa por atraso de pagamento.
     */
    private $fines;

    /** @var int
     * Multa % a ser cobrada para pagamentos efetuados após a data de vencimento.
     */
    private $late_payment_fine;

    /** @var bool
     * Booleano que determina se cobra ou não juros por dia de atraso. 1% ao mês pro rata.
     */
    private $per_day_interest;

    /** @var bool
     * Booleano que ignora o envio do e-mail de cobrança.
     */
    private $ignore_due_email;

    /** @var string
     * Amarra esta Fatura com a Assinatura especificada. Esta fatura não causa alterações na assinatura vinculada.
     */
    private $subscription_id;

    /** @var string
     * Método de pagamento que será disponibilizado para esta Fatura.
     * 
     * Métodos disponíveis:
     * all
     * credit_card
     * bank_slip
     * 
     */
    private $payable_with;

    /** @var int
     * Caso tenha o 'subscription_id', pode-se enviar o número de créditos a adicionar
     * nessa Assinatura baseada em créditos, quando a Fatura for paga.
     * 
     */
    private $credits;

    /** @var bool
     * Ativa ou desativa os descontos por pagamento antecipado. Quando true, sobrepõe as configurações de desconto da conta.
     * 
     */
    private $early_payment_discount;

    /** @var array
     * Quantidade de dias de antecedência para o pagamento receber o desconto (Se enviado, substituirá a configuração atual da conta).
     * 
     */
    private $early_payment_discounts;

    /** @var array
     * Cliente.
     * 
     */
    private $payer;

    /** @var array
     * Número único que identifica o pedido de compra. Opcional, ajuda a evitar o pagamento da mesma fatura.
     * 
     */
    private $order_id;

    /**
     * @param $json
     *
     * @return Invoice
     */
    public static function fromJson($json)
    {
        $object = json_decode($json);
        $invoice = new Invoice();
        $invoice->populate($object);
        return $invoice;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * @param \stdClass $data
     */
    public function populate(\stdClass $data)
    {
        foreach (get_object_vars($this) as $key => $value) {
            $this->{$key} = $data->{$key} ?? null;
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
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * @param $due_date
     *
     * @return $this
     */
    public function setDueDate($due_date)
    {
        $this->due_date = $due_date;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return int
     */
    public function getDiscountCents()
    {
        return $this->discount_cents;
    }

    /**
     * @param $discount_cents
     *
     * @return $this
     */
    public function setDiscountCents($discount_cents)
    {
        $this->discount_cents = $discount_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getItemsTotalCents()
    {
        return $this->items_total_cents;
    }

    /**
     * @param $items_total_cents
     *
     * @return $this
     */
    public function setItemsTotalCents($items_total_cents)
    {
        $this->items_total_cents = $items_total_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getNotificationUrl()
    {
        return $this->notification_url;
    }

    /**
     * @param $notification_url
     *
     * @return $this
     */
    public function setNotificationUrl($notification_url)
    {
        $this->notification_url = $notification_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    /**
     * @param $return_url
     *
     * @return $this
     */
    public function setReturnUrl($return_url)
    {
        $this->return_url = $return_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return int
     */
    public function getTaxCents()
    {
        return $this->tax_cents;
    }

    /**
     * @param $tax_cents
     *
     * @return $this
     */
    public function setTaxCents($tax_cents)
    {
        $this->tax_cents = $tax_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param $updated_at
     *
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotalCents()
    {
        return $this->total_cents;
    }

    /**
     * @param $total_cents
     *
     * @return $this
     */
    public function setTotalCents($total_cents)
    {
        $this->total_cents = $total_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaidAt()
    {
        return $this->paid_at;
    }

    /**
     * @param $paid_at
     *
     * @return $this
     */
    public function setPaidAt($paid_at)
    {
        $this->paid_at = $paid_at;
        return $this;
    }

    /**
     * @return int
     */
    public function getCommissionCents()
    {
        return $this->commission_cents;
    }

    /**
     * @param $commission_cents
     *
     * @return $this
     */
    public function setCommissionCents($commission_cents)
    {
        $this->commission_cents = $commission_cents;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecureId()
    {
        return $this->secure_id;
    }

    /**
     * @param $secure_id
     *
     * @return $this
     */
    public function setSecureId($secure_id)
    {
        $this->secure_id = $secure_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecureUrl()
    {
        return $this->secure_url;
    }

    /**
     * @param $secure_url
     *
     * @return $this
     */
    public function setSecureUrl($secure_url)
    {
        $this->secure_url = $secure_url;
        return $this;
    }

    /**
     * @return string|null
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
     * @return string|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param $user_id
     *
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param $total
     *
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxesPaid()
    {
        return $this->taxes_paid;
    }

    /**
     * @param $taxes_paid
     *
     * @return $this
     */
    public function setTaxesPaid($taxes_paid)
    {
        $this->taxes_paid = $taxes_paid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @param $commission
     *
     * @return $this
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param $interest
     *
     * @return $this
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param $discount
     *
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getRefundable()
    {
        return $this->refundable;
    }

    /**
     * @param $refundable
     *
     * @return $this
     */
    public function setRefundable($refundable)
    {
        $this->refundable = $refundable;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInstallments()
    {
        return $this->installments;
    }

    /**
     * @param $installments
     *
     * @return $this
     */
    public function setInstallments($installments)
    {
        $this->installments = $installments;
        return $this;
    }

    /**
     * @return object
     */
    public function getBankSlip()
    {
        return $this->bank_slip;
    }

    /**
     * @param $bank_slip
     *
     * @return $this
     */
    public function setBankSlip($bank_slip)
    {
        $this->bank_slip = $bank_slip;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param $items
     *
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }

    /**
     * @return array
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

    
    /**
     * @param $logs
     *
     * @return $this
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setLogs($logs)
    {
        $this->logs = $logs;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getCcEmail()
    {
        return $this->cc_email;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setCcEmail($cc_email)
    {
        $this->cc_email = $cc_email;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getEnsureWorkdayDueDate()
    {
        return $this->ensure_workday_due_date;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setEnsureWorkdayDueDate($ensure_workday_due_date)
    {
        $this->ensure_workday_due_date = $ensure_workday_due_date;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getExpiredUrl()
    {
        return $this->expired_url;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setExpiredUrl($expired_url)
    {
        $this->expired_url = $expired_url;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getFines()
    {
        return $this->fines;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setFines($fines)
    {
        $this->fines = $fines;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getLatePaymentFine()
    {
        return $this->late_payment_fine;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setLatePaymentFine($late_payment_fine)
    {
        $this->late_payment_fine = $late_payment_fine;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getPerDayInterest()
    {
        return $this->per_day_interest;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setPerDayInterest($per_day_interest)
    {
        $this->per_day_interest = $per_day_interest;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getIgnoreDueEmail()
    {
        return $this->ignore_due_email;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setIgnoreDueEmail($ignore_due_email)
    {
        $this->ignore_due_email = $ignore_due_email;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getSubscriptionId()
    {
        return $this->subscription_id;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setSubscriptionId($subscription_id)
    {
        $this->subscription_id = $subscription_id;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getPayableWith()
    {
        return $this->payable_with;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setPayableWith($payable_with)
    {
        $this->payable_with = $payable_with;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setCredits($credits)
    {
        $this->credits = $credits;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getEarlyPaymentDiscount()
    {
        return $this->early_payment_discount;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function setEarlyPaymentDiscount($early_payment_discount)
    {
        $this->early_payment_discount = $early_payment_discount;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getEarlyPaymentDiscounts()
    {
        return $this->early_payment_discounts;
    }

    /**
     * @param $early_payment_discounts
     *
     * @return $this
     */
    public function setEarlyPaymentDiscounts($early_payment_discounts)
    {
        $this->early_payment_discounts = $early_payment_discounts;
        return $this;
    }

    /**
     * @param $logs
     *
     * @return $this
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param $payer
     *
     * @return $this
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * @param $order_id
     *
     * @return $this
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param $order_id
     *
     * @return $this
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
        return $this;
    }

}
